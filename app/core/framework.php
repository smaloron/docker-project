<?php

/**
 * @param string $route
 * @param array<string,string> $routeMap
 * @return string
 * 
 * Retourne un nom de fichier php correspondant à un contrôleur
 * en fonction d'une route et d'un table de routage 
 */
function getController(string $route, array $routeMap): string{
    // La route est-elle référencée
    if(! array_key_exists($route, $routeMap)){
        return "not-found.php";
    }

    // récupération du contrôleur en fonction de la route
    $controller = $routeMap[$route];

    // Le contr$oleur existe-t-il ?
    if(! file_exists(CONTROLLER_PATH . $controller)){
        return "not-found.php";
    }

    return $controller;
}