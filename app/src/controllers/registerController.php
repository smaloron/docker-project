<?php

$isPosted = filter_has_var(INPUT_POST, "submit");
$errors = [];

if($isPosted){
    // Récupération de la saisie
    $login = filter_input(INPUT_POST, "login", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $plainPassword = filter_input(INPUT_POST, "password", FILTER_DEFAULT);

    // Validation des saisies
    if(empty($login)){
        array_push($errors, "Le login ne peut être vide");
    }
    if(empty($name)){
        array_push($errors, "Le nom ne peut être vide");
    }
    if(empty($plainPassword)){
        array_push($errors, "Le mot de passe ne peut être vide");
    }
    if(strlen($plainPassword)<5){
        array_push($errors, "Le mot de passe doit faire plus de 4 caractères");
    }

    // Insertion s'il n'y a pas d'erreurs
    if(count($errors) === 0){
        try {
            // hachage du mot de passe
            $pass = password_hash($plainPassword, PASSWORD_DEFAULT);
            // Définition et exécution de la requête SQL
            $sql = "INSERT INTO users (login_name, password_hash, user_name) VALUES (?,?,?)";
            $statement = $pdo->prepare($sql);
            $statement->execute([$login, $pass, $name]);
            // redirection
            header("location:/accueil");
        }catch(PDOException $ex){
            array_push($errors, "Erreur avec la base de données");
        }
    }
}

var_dump($errors);

// Affichage de la vue
$contentView = VIEW_PATH. "registerForm.php";
require VIEW_PATH. "layout.php";