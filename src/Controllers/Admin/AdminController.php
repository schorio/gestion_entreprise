<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\AdminModel;

/**
 * la classe qui gérent l'administration du site
 */
class AdminController extends Controller
{
    /**
     * admin model qui gérent l'accés aux base de données des données des administrateurs
     *
     * @var AdminModel
     */
    private AdminModel $adminModel;

    public function __construct()
    {
        parent::__construct();
        $this->adminModel = new AdminModel;
    }

    /**
     * affichage de la page d'accueil de l'admin
     *
     * @return void
     */
    public function index()
    {
        // on verifie si l'administrateur n'est pas connecté
        if(!isset($_SESSION["admin"]))
        {
            $_SESSION['alert'] = ["type" => "warning", "message" => "Vous devez d'abord vous connecter!"];
            $this->redirect("/admin/connexion");
        }
        // sinon
        $this->render("admin/index", ["title" => "Admin index"]);
    }

    /**
     * affichage de la page de connexion de l'admin
     *
     * @return void
     */
    public function connexion()
    {        
        // on verifie si l'admin est déjà connecté
        if (isset($_SESSION['admin'])) {
            $this->redirect("/admin");
        }

        // si le formulaire de connexion est submiter
        if(isset($_POST['connexion']))
        {
            // si le formulaire est valide
            if(isset($_POST['email']) && $_POST['email'] != "" &&
                isset($_POST["password"]) && $_POST["password"] != ""
                && (isset($_POST['token']) && $_SESSION['token'] == $_POST['token'])
            )
            {
                // on netoie les données des injections 
                $email = strip_tags($_POST["email"]);
                $password = strip_tags($_POST["password"]);
                // on encode le mot de passe
                //$password = password_hash($password, PASSWORD_BCRYPT);
                $admin = $this->adminModel->findOneByEmail($email);
                // si l'utilisateur existe
                if($admin) {
                    $admin = $this->adminModel->hydrate($admin);
                    // si le mot de passe correspond
                    if(password_verify($password, $admin->getPassword())) {
                        $this->adminModel->setSession();
                        $this->redirect("/admin");
                    }
                    else // sinon retourner message d'alert
                    {
                        $_SESSION["alert"] =  ["type" => "warning", "message" => "Identifiants non reconnus!"];
                        $this->redirect("/admin/connexion");
                    }
                }
                else // sinon retourner message d'alert
                {
                    $_SESSION["alert"] =  ["type" => "warning", "message" => "Identifiants non reconnus!"];
                    $this->redirect("/admin/connexion");
                }
            }
            //sinon retourner message d'alert
            else{
                $_SESSION["alert"] =  ["type" => "warning", "message" => "Tous les champs sont réquis!"];
                $this->redirect("/admin/connexion");
            }
        }

        // création d'un token pour la securité du formulaire
        if(!isset($_SESSION['token']))
        {
            $token = md5(uniqid());
            $_SESSION["token"] = $token;
        }

        //rendu de la page
        $this->render("admin/connexion", ["title" => "Admin connexion"]);

        // on supprime les messages d'alerts après affichage 
        if(isset($_SESSION['alert'])){
            unset($_SESSION['alert']);
        }
    }

    public function deconnexion()
    {
        unset($_SESSION['admin']);
        $this->redirect("/admin/connexion");
    }
}