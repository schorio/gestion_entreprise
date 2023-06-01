<?php

namespace App\Controllers;

use App\Core\Controller;

/**
 * Undocumented class
 */
class ErrorController extends Controller
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function error404()
    {
        $this->render("error/404");
    }
}