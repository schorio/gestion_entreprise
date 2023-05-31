<?php 

namespace App\Core;

use App\Controllers\ErrorController;
use App\Controllers\MainController;

/**
 * Cette classe se charge de la decomposition de l'url et les associent à des controleurs bien définis
 */
class Main
{
    public function start()
    {
        $uri = $_SERVER['REQUEST_URI'];

        // on enleve le "/" si l'url se termine par "/"
        if(!empty($uri) && $uri != "/" && $uri[-1] === "/")
        {
            $uri = substr($uri, 0, -1);

            http_response_code(301);
            // On fait une redirection vers le nouveau url pour le traitement
            header("Location: " . $uri);
        }

        // On transforme l'url à un tableau
        $uri = parse_url($uri, PHP_URL_PATH);
        $segments = explode('/', $uri);
        array_shift($segments);
        // Si l'url contient un premier arguments
        if($segments[0] !== "")
        {
            $first_arguments = $segments[0];
            //on cherche si l'argument correspond à un dossier dans le controleurs
            $directories = ["Admin", "Client"];
            if(in_array($first_arguments, $directories)){
                array_shift($segments);
            }
            // on cherche une controleur qui correspond à l'arguments
            $controller = "\\App\\Controllers\\". ucfirst($first_arguments) . "\\" . ucfirst(array_shift($segments)) . "Controller";

            // si la classe existe
            if(class_exists($controller))
            {
                $controller = new $controller();
                // si un second arguments existe, on l'associe à un action (méthode), sinon on l'associe à la méthode index du controleur
                $action = (isset($segments[0])) ? array_shift($segments) : "index";

                //si l'action existe, on l'appele la methode avec en paramètre les restes de l'argument
                if(method_exists($controller, $action))
                {
                    (isset($segments[0])) ? $controller->$action($segments) : $controller->$action();
                }
                // sinon page introuvable
                else
                {
                    http_response_code(404);
                    $controller = new ErrorController;
                    $controller->error404();
                }
            }
            // sinon rechercher dans main controller si la methode existe
            else
            {
                $controller = new MainController;
                if (method_exists($controller, $first_arguments)) {
                    $controller->$first_arguments();
                }
                // sinon retourner erreur 404 page introuvable  
                else
                {
                    http_response_code(404);
                    $controller = new ErrorController;
                    $controller->error404();
                }
            }
        }
        // sinon c'est l'url de base
        else
        {
            $controller = new MainController;
            $controller->index();
        }
    }
}