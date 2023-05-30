<?php

namespace App\Controllers;

use App\Core\Controller;

class ErrorController extends Controller
{
    public function error404()
    {
        $this->twig->display("error/404.html.twig");
    }
}