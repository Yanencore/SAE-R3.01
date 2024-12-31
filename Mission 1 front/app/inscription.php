<?php
if(!session_id())
    session_start();

require_once 'BddConnect.php';
require_once 'UserBddMySQL.php';
require_once 'Authentification.php';
$bdd = new BddConnect();
$pdo = $bdd->connexion();
$trousseau = new UserBddMySQL($pdo);
$auth = new Authentification($trousseau);

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        $retour = $auth->register($_POST['nom'],$_POST['prenom'],$_POST['email'], $_POST['mot-de-passe'], $_POST['conf-mot-de-passe']);
        $message = "Vous êtes enregistré. Vous pouvez vous authentifier";
        $code = "success";
    }
    catch(Exception $e) {
        $retour = false;
        $message = "Enregistrement impossible : " . $e->getMessage();
        $code = "warning";
    }


    $_SESSION['flash'][$code] = $message;

    $direction = $_SERVER['HTTP_ORIGIN'];

}

