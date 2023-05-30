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
        $this->twig->display("admin/index.html.twig");
    }
}