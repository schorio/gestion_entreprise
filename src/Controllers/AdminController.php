<?php

namespace App\Controllers;

use App\Core\Controller;

/**
 * la classe qui gérent l'administration
 */
class AdminController extends Controller
{
    public function index()
    {
        $this->render("admin/index", ["title" => "Admin index"]);
    }

    public function connexion()
    {
        $this->render("admin/connexion", ["title" => "Admin connexion"]);
    }
}