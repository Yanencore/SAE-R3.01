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
    <link rel="stylesheet" href="stylesheet/mon-espace.css">
    <script src="scripts/jquery.js"></script>
    <script src="scripts/menu.js"></script>
</head>
<body>
    <header></header>
    <div id="global">

        <div id="profile">
            <img src="images/mon-espace/profil.png"  alt="profile">
            <ul>
                <li>Nom :</li>
                <li><div class="user-info"><?=htmlspecialchars($user->getNom())?></div></li>
                <li>Prénom :</li>
                <li><div class="user-info"><?=htmlspecialchars($user->getPrenom())?></div></li>
                <li>Email :</li>
                <li><div class="user-info"><?=htmlspecialchars($user->getEmail())?></div></li>
            </ul>
            <a href="deleteUser.php"><button><u>clôturer votre compte</u></button></a>
        </div>

        <div id="enquetes">

            <a href="sondage.html">
                <div>
                    <h2>Enquête sur la qualité de vie, l'insertion sociale et les besoins de soutien</h2>
                    <h3><u>Date de sortie : 03/01/2025</u><svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                                               xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.5 2H2.5C2.22386 2 2 2.22386 2 2.5V12.5C2 12.7761 2.22386 13 2.5 13H12.5C12.7761
                            13 13 12.7761 13 12.5V2.5C13 2.22386 12.7761 2 12.5 2ZM2.5 1C1.67157 1 1 1.67157 1 2.5V12.5C
                            1 13.3284 1.67157 14 2.5 14H12.5C13.3284 14 14 13.3284 14 12.5V2.5C14 1.67157 13.3284 1 12.5
                             1H2.5Z" fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path></svg></h3>
                    <p>
                        Ce sondage vise à mieux comprendre les expériences et perceptions des participants concernant leurs
                        conditions de vie actuelles, leurs interactions sociales et leurs parcours d'intégration dans la société.
                    </p>
                </div>

            </a>
            <a href="">
                <div>
                    <h2>Évaluation des habitudes de santé et du bien-être général</h2>
                    <h3><u>Date de sortie : 01/10/2024</u><svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                                               xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.5 2H2.5C2.22386 2 2 2.22386 2 2.5V12.5C2 12.7761 2.22386 13 2.5 13H12.5C12.7761
                            13 13 12.7761 13 12.5V2.5C13 2.22386 12.7761 2 12.5 2ZM2.5 1C1.67157 1 1 1.67157 1 2.5V12.5C
                            1 13.3284 1.67157 14 2.5 14H12.5C13.3284 14 14 13.3284 14 12.5V2.5C14 1.67157 13.3284 1 12.5
                             1H2.5Z" fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path></svg></h3>
                    <p>
                        Ce sondage a pour but de recueillir des informations sur vos habitudes de vie, votre état de santé
                        global et votre bien-être. Il vise à identifier les pratiques qui contribuent à une meilleure
                        qualité de vie et à repérer les besoins éventuels
                    </p>
                </div>
            </a>

        </div>
    </div>
    <footer></footer>
</body>
</html>
