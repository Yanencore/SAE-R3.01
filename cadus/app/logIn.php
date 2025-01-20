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
$logError = null;

//login.php gère la connexion de l'utilisateur.


if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $email =  filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars($_POST['mot-de-passe'], ENT_QUOTES, 'UTF-8');

    if ($email != "" && $password != ""){
        try {
            if ($auth->authenticate($email,$password)){
                setcookie("token",$trousseau->createUserToken($email), time() + 3600,"/");
                setcookie("email",$email,time()+3600, "/",);
                header("Location: ../mon-espace.php");
                exit();
            }
        }
        catch (Exception $e){
            $logError = $e->getMessage();
            $_SESSION['errors'] = ['logIn' => $logError,];
            header("Location: ../se-connecter.php");
            exit();
        }

    }
}
