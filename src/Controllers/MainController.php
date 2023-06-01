<?php

namespace App\Controllers;

use App\Core\Controller;

/**
 * Undocumented class
 */
class MainController extends Controller
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function index()
    {
        $this->render("main/index", ["title" => "Page de présentation"]);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function inscription(): void
    {
        $this->render("main/inscription", ["title" => "Page d'inscription"]);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function connexion(): void
    {
        $this->render("main/connexion", ["title" => "Page de connexion"]);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function apropos(): void
    {
        $this->render("main/a-propos", ["title" => "Page à propos"]);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function contact(): void
    {
        $this->render("main/contact", ["title" => "Page de contact"]);
    }
}