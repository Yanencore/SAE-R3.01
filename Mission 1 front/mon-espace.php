<?php
require_once 'app/UserBddMySQL.php';
require_once 'app/BddConnect.php';
$bdd = new BddConnect();
$pdo = $bdd->connexion();
$trousseau = new UserBddMySQL($pdo);

if (!$trousseau->isUserConnected()){
    header("Location: se-connecter.php");
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Mon espace</title>
    <link rel="stylesheet" href="stylesheet/style.css">
    <script src="scripts/jquery.js"></script>
    <script src="scripts/menu.js"></script>
</head>
<body>
    <header></header>
    <?php
    if ($trousseau->isUserConnected())
        echo "vous êtes connecter !";
    ?>
    <footer></footer>
</body>
</html>
