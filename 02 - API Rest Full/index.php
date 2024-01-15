<?php
require_once "Controlers/routes.controler.php";
require_once "Controlers/courses.controler.php";
require_once "Controlers/register.controler.php";
$routes = new controlerRoutes();
$routes->index();
?>