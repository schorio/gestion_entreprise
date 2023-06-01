<?php 

namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Undocumented class
 */
abstract class Controller
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $loader;
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $twig;

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected array $data;

    /**
     * Undocumented function
     */
    public function __construct()
    {
        $this->loader = new FilesystemLoader(ROOT . "/src/templates");
        $this->twig = new Environment($this->loader);
        $this->twig->addGlobal("session", $_SESSION);
        $this->data['assets_url'] = BASE_URL . '/assets';
    }

    /**
     * Undocumented function
     *
     * @param string $file
     * @param array|null $_data
     * @return void
     */
    public function render(string $file, ?array $_data = null): void
    {
        if(isset($_data))
        {
            foreach($_data as $key => $value)
            {
                $this->data[$key] = $value;
            }

            array_push($this->data, $_data);
        }

        $file = $file . ".html.twig";
        $this->twig->display($file, $this->data);
    }

    public function redirect(string $url)
    {
        http_response_code(301);
        header("Location: " . $url);
        exit();
    }


}