<?php 

namespace App\Controllers;

use App\Core\Controller;

class ClientController extends Controller
{
    /**
     * display index page
     *
     * @return void
     */
    public function index(): void
    {
        $this->twig->display("client/index.html.twig");
    }

    public function inscription(): void
    {
        $this->twig->display("client/inscription.html.twig");
    }

}