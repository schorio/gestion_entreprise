<?php 

namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    private $loader;
    protected $twig;

    protected array $data;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(ROOT . "/src/templates");
        $this->twig = new Environment($this->loader);
        $this->data['assets_url'] = BASE_URL . '/assets';
    }

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


}