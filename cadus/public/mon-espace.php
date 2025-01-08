<?php
require_once '../app/User.php';
require_once '../app/UserBddMySQL.php';
require_once '../app/BddConnect.php';
$bdd = new BddConnect();
$pdo = $bdd->connexion();
$trousseau = new UserBddMySQL($pdo);

if (!$trousseau->isUserConnected()){
    header("Location: se-connecter.php");
}
$user = $trousseau->findUserByEmail($_COOKIE['email']);
$aRepondu1 = $trousseau->didTheSurvey();

require_once './header.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Mon espace</title>
    <link rel="stylesheet" href="assets/css/mon-espace.css">
</head>
<body>
    <div id="global">

        <div id="profile">
            <img src="assets/img/mon-espace/profil.png" alt="profile">
            <ul>
                <li>Nom :</li>
                <li><div class="user-info"><?=htmlspecialchars($user->getNom())?></div></li>
                <li>Prénom :</li>
                <li><div class="user-info"><?=htmlspecialchars($user->getPrenom())?></div></li>
                <li>Email :</li>
                <li><div class="user-info"><?=htmlspecialchars($user->getEmail())?></div></li>
            </ul>
            <a href="deleteAccount.php"><button><u>clôturer votre compte</u></button></a>
        </div>

        <div id="enquetes">

            <a href="sondage.php"   <?php echo $aRepondu1 ? 'style="pointer-events: none; color: gray;"' : ''; ?>>

                <div>
                    <h2>Enquête sur la qualité de vie, l'insertion sociale et les besoins de soutien</h2>
                    <h3><u>Date de sortie : 03/01/2025</u> <?php if ($trousseau->didTheSurvey()) : ?><svg class="yes" width="20" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 3H12V12H3L3 3ZM2 3C2 2.44771 2.44772 2 3 2H12C12.5523 2 13 2.44772 13 3V12C13 12.5523 12.5523 13 12 13H3C2.44771 13 2 12.5523 2 12V3ZM10.3498 5.51105C10.506 5.28337 10.4481 4.97212 10.2204 4.81587C9.99275 4.65961 9.6815 4.71751 9.52525 4.94519L6.64048 9.14857L5.19733 7.40889C5.02102 7.19635 4.7058 7.16699 4.49327 7.34329C4.28073 7.5196 4.25137 7.83482 4.42767 8.04735L6.2934 10.2964C6.39348 10.4171 6.54437 10.4838 6.70097 10.4767C6.85757 10.4695 7.00177 10.3894 7.09047 10.2601L10.3498 5.51105Z" fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path></svg><?php endif; ?>
                                                           <?php if (!$trousseau->didTheSurvey()) : ?><svg class="no" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.5 2H2.5C2.22386 2 2 2.22386 2 2.5V12.5C2 12.7761 2.22386 13 2.5 13H12.5C12.7761 13 13 12.7761 13 12.5V2.5C13 2.22386 12.7761 2 12.5 2ZM2.5 1C1.67157 1 1 1.67157 1 2.5V12.5C1 13.3284 1.67157 14 2.5 14H12.5C13.3284 14 14 13.3284 14 12.5V2.5C14 1.67157 13.3284 1 12.5 1H2.5Z" fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path></svg><?php endif; ?></h3>
                    <p>
                        Ce sondage vise à mieux comprendre les expériences et perceptions des participants concernant leurs
                        conditions de vie actuelles, leurs interactions sociales et leurs parcours d'intégration dans la société.
                    </p>
                </div>

            </a>
            <a href="">
                <div>
                    <h2>Évaluation des habitudes de santé et du bien-être général</h2>
                    <h3><u>Date de sortie : 01/10/2024</u><svg class="no" width="15" height="15" viewBox="0 0 15 15" fill="none"
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
</body>
<?php
require_once './footer.html';
?>
</html>
