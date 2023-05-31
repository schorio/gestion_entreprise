<?php

namespace App\Controllers;

use App\Core\Controller;

class MainController extends Controller
{
    public function index()
    {
        $this->render("main/index", ["title" => "Page de présentation"]);
    }

    public function inscription(): void
    {
        $this->render("main/inscription", ["title" => "Page d'inscription"]);
    }

    public function connexion(): void
    {
        $this->render("main/connexion", ["title" => "Page de connexion"]);
    }
}