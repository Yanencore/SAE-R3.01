<?php
if(!session_id())
    session_start();

require_once '../app/BddConnect.php';
require_once '../app/UserBddMySQL.php';
require_once '../app/Authentification.php';

$bdd = new BddConnect();
$pdo = $bdd->connexion();
$trousseau = new UserBddMySQL($pdo);
$auth = new Authentification($trousseau);
$emailError = null;
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars($_POST['mot-de-passe'], ENT_QUOTES, 'UTF-8');
    $confPassword = $_POST['conf-mot-de-passe'];
    
    try {
        $auth->register($nom, $prenom, $email, $password, $confPassword);
        $_SESSION['flash']['success'] = "Inscription réussie";
        setcookie("token",$trousseau->createUserToken($email), time() + 3600,"/");
        setcookie("email",$email,time()+3600, "/",);
        header("Location: http://$host$uri/mon-espace.php");
        exit;
    } catch (Exception $e) {
        echo $e->getMessage();
        if (str_contains($e->getMessage(), 'déjà enregistré')) {
            $emailError = "Cet email est déjà associé à un compte.";
        }
    }
}

$_SESSION['errors'] = ['email' => $emailError,];

header("Location: http://$host$uri/creer-un-compte.php");
exit;

