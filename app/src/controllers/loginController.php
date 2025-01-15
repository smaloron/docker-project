<?php

$isPosted = filter_has_var(INPUT_POST, "submit");
$errors = [];

if($isPosted){
    // Récupération de la saisie
    $login = filter_input(INPUT_POST, "login", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $plainPassword = filter_input(INPUT_POST, "password", FILTER_DEFAULT);

    // Validation des saisies
    if(empty($login)){
        array_push($errors, "Le login ne peut être vide");
    }
    if(empty($plainPassword)){
        array_push($errors, "Le mot de passe ne peut être vide");
    }


    // Insertion s'il n'y a pas d'erreurs
    if(count($errors) === 0){
        try {
            // Récupération des infos de l'utilisateur
            $sql = "SELECT * FROM users WHERE login_name = ?";
            $statement = $pdo->prepare($sql);
            $statement->execute([$login]);
            $user = $statement->fetch();
            if($user === false){
                array_push($errors, "Impossible de trouver l'utilisateur");
            } else {
                if(! password_verify($plainPassword, $user['password_hash'])){
                    array_push($errors, "Mot de passe incorrect");
                } else {
                    unset($user['password_hash']);
                    $_SESSION['user'] = $user;
                    header("location:/accueil");
                }
            }

        }catch(PDOException $ex){
            array_push($errors, "Erreur avec la base de données");
        }
    }
}


// Affichage de la vue
$contentView = VIEW_PATH. "loginForm.php";
require VIEW_PATH. "layout.php";
