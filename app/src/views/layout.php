<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Application</title>
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
>
</head>
<body>
    <main class="container" style="background:#CCC; padding: 10px">
        <nav>
            <ul>
                <li><a href="/accueil">Accueil</a></li>
                <li><a href="/inscription">Inscription</a></li>
                <li><a href="/connexion">Connexion</a></li>
            </ul>
        </nav>
        <?php  include $contentView ?>
    </main>
</body>
</html>