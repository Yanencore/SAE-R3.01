<?php
require_once '../app/User.php';
require_once '../app/UserBddMySQL.php';
require_once '../app/BddConnect.php';
$bdd = new BddConnect();
$pdo = $bdd->connexion();
$trousseau = new UserBddMySQL($pdo);

if ($trousseau->isUserConnected()){
    $trousseau->deleteYourAccount();
}
header("Location: ./se-connecter.php");


