<?php
require_once "Controlers/routes.controler.php";
require_once "Controlers/courses.controler.php";
require_once "Controlers/register.controler.php";
require_once "Models/register.model.php";
require_once "Models/courses.model.php";
$routes = new controlerRoutes();
$routes->index();
?>