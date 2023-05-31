<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\AdminModel;

/**
 * la classe qui gérent l'administration
 */
class AdminController extends Controller
{
    private $adminModel;

    public function __construct()
    {
        parent::__construct();
        $this->adminModel = new AdminModel;
    }

    public function index()
    {
        $this->render("admin/index", ["title" => "Admin index"]);
    }

    public function connexion()
    {
        $this->render("admin/connexion", ["title" => "Admin connexion"]);
    }
}