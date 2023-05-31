<?php 

namespace App\Controllers\Client;

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

}