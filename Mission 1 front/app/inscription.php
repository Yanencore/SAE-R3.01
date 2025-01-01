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
$emailError = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $password = $_POST['mot-de-passe'];
    $confPassword = $_POST['conf-mot-de-passe'];

    try {
        $auth->register($nom, $prenom, $email, $password, $confPassword);
        $_SESSION['flash']['success'] = "Inscription réussie";
        exit;
    } catch (Exception $e) {

        if (str_contains($e->getMessage(), 'déjà enregistré')) {
            $emailError = "Cet email est déjà associé à un compte.";
        }
    }
}

$_SESSION['errors'] = ['email' => $emailError,];

header("Location: ../creer-un-compte.php");
exit;

