<?php


define("ROOT", dirname(__DIR__));

require_once ROOT."\\config\\config.php";
require_once ROOT."\\vendor\\autoload.php";

use App\Core\Main;

$app = new Main();

session_start();

$app->start();

?>