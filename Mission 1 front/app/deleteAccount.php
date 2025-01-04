<?php
require_once 'User.php';
require_once 'UserBddMySQL.php';
require_once 'BddConnect.php';
$bdd = new BddConnect();
$pdo = $bdd->connexion();
$trousseau = new UserBddMySQL($pdo);

if ($trousseau->isUserConnected()){
    $trousseau->deteleYourAccount();
}
header("Location: ../se-connecter.php");


