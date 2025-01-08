<?php
if (!session_id()) {
    session_start();
}
$logError = $_SESSION['errors']['logIn'] ?? null;
unset($_SESSION['errors']);
require_once './header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CADUS | Sign in</title>
    <link rel="stylesheet" href="assets/css/se-connecter.css">
    <script src="assets/js/formSignIn.js"></script>
</head>
<body>
<div id="global">
    <h1 id="hSeConnecter">Se connecter</h1>
    <div id="formConnexion">
        <form method="post" action="logIn.php">
            <ul>
                <li>
                    <label for="mail">Email</label>
                    <input type="email" id="mail" class="label-input" name="email" placeholder="" required>
                </li>
                <li>
                    <label for="mot-de-passe">Mot-de-Passe</label>
                    <input type="password" id="mot-de-passe" class="label-input" name="mot-de-passe" required>
                    <?php if ($logError): ?>
                        <span class="error-text"><?= htmlspecialchars($logError) ?></span>
                    <?php endif; ?>
                </li>
                <li>
                    <a href=""><u>mot de passe oublié ?</u></a>
                </li>
                <li>
                    <input type="checkbox" id="showPswd"/>
                    <label for="showPswd">Afficher le mot de passe</label>
                </li>
                <li>
                    <input id="submit-input" type="submit" value="connexion">
                </li>
            </ul>
        </form>
    </div>
    <hr>
    <h2>Pas encore de compte ?</h2>
    <div id="div-btn">
        <a href="creer-un-compte.php">
            <button>
                <img src="assets/img/ce_qu_il_faut_savoir/more.png" alt="">
            </button>
        </a>
    </div>
</div>
</body>
<?php
require_once './footer.html';
?>
</html>