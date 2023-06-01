<?php 

namespace App\Controllers\Client;

use App\Core\Controller;

/**
 * Undocumented class
 */
class ClientController extends Controller
{
    /**
     * Undocumented function
     */
    public function __construct()
    {
        parent::__construct();
    }

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