<?php
require_once 'app/User.php';
require_once 'app/UserBddMySQL.php';
require_once 'app/BddConnect.php';
$bdd = new BddConnect();
$pdo = $bdd->connexion();
$trousseau = new UserBddMySQL($pdo);

if (!$trousseau->isUserConnected()){
    header("Location: se-connecter.php");
}
$user = $trousseau->findUserByEmail($_COOKIE['email']);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Mon espace</title>
    <link rel="stylesheet" href="stylesheet/style.css">
    <link rel="stylesheet" href="stylesheet/mon-espace.php.css">
    <script src="scripts/jquery.js"></script>
    <script src="scripts/menu.js"></script>
</head>
<body>
    <header></header>
    <div id="global">

        <div id="profile">
            <img src="images/mon-espace/profil.png"  alt="profile">
            <ul>
                <li>Nom : <?=htmlspecialchars($user->getNom())?></li>
                <li>Prénom : <?=htmlspecialchars($user->getPrenom())?></li>
                <li>Email : <?=htmlspecialchars($user->getEmail())?></li>
            </ul>
            <a href="deleteUser.php"><button>clôturer votre compte</button></a>
        </div>

        <div id="enquetes">
            <div>
                <h2>Enquête sur la qualité de vie, l'insertion sociale et les besoins de soutien</h2>
                <h3>Date de sortie : 03/01/2025</h3>
                <p>
                    Ce sondage vise à mieux comprendre les expériences et perceptions des participants concernant leurs
                    conditions de vie actuelles, leurs interactions sociales et leurs parcours d'intégration dans la société.
                </p>
            </div>
            <div>
                <h2>Évaluation des habitudes de santé et du bien-être général</h2>
                <h3>Date de sortie : 01/10/2024</h3>
                <p>
                    Ce sondage a pour but de recueillir des informations sur vos habitudes de vie, votre état de santé
                    global et votre bien-être. Il vise à identifier les pratiques qui contribuent à une meilleure
                    qualité de vie et à repérer les besoins éventuels
                </p>
            </div>
        </div>
    </div>
    <footer></footer>
</body>
</html>
