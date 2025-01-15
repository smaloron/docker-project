<?php
session_start();

define("ROOT_PATH", dirname(__DIR__));
define("CONTROLLER_PATH", ROOT_PATH."/src/controllers/");
define("CONFIG_PATH", ROOT_PATH."/src/config/");
define("VIEW_PATH", ROOT_PATH."/src/views/");

// Inclusion du framework
require ROOT_PATH. "/core/framework.php";

// définition de la connexion à la bd
$pdo = getPDO(
    "mysql:host=mariadb;dbname=formation;charset=utf8",
    "user", "123"
);



$route = filter_input(INPUT_GET, "route") ?? "/accueil";
$routeMap = require CONFIG_PATH . "routes.php";

require CONTROLLER_PATH . getController($route, $routeMap);

