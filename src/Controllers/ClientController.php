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
        $this->render("client/index");
    }

    public function inscription(): void
    {
        $this->render("client/inscription");
    }

    public function connexion(): void
    {
        $this->render("client/connexion");
    }

}