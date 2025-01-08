<?php
if (!session_id()) {
    session_start();
}
$emailError = $_SESSION['errors']['email'] ?? null;
unset($_SESSION['errors']);
require_once './header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CADUS | Sign up</title>
    <link rel="stylesheet" href="assets/css/creer-un-compte.css">
    <script src="assets/js/formSignUp.js"></script>
</head>
<body>

<div id="global">
    <h1 id="hCreerUnCompte">Créer un compte</h1>
    <div id="formInsciption">
        <form method="post" action="signUp.php">
            <ul>
                <li>
                    <label for="nom">Nom*</label>
                    <input type="text" id="nom" class="label-input" name="nom" placeholder="Dupont" required>
                </li>
                <li>
                    <label for="prenom">Prénom*</label>
                    <input type="text" id="prenom" class="label-input" name="prenom" placeholder="Jean" required>
                </li>
                <li>
                    <label for="mail">Email*</label>
                    <input type="email" id="mail" class="label-input" name="email" placeholder="jeandupont@gmail.com"
                           required>
                    <?php if ($emailError): ?>
                        <span class="error-text"><?= htmlspecialchars($emailError) ?></span>
                        <span class="error-text"><a href="se-connecter.php">Connectez-vous ici.</a></span>
                    <?php endif; ?>
                </li>
                <li>
                    <label for="mot-de-passe">Mot-de-Passe*</label>
                    <input type="password" id="mot-de-passe" class="label-input" name="mot-de-passe" required>
                    <p>Votre mot de passe doit contenir au moins 8 caractères, 1 lettre majuscule et 1 chiffre.</p>
                </li>
                <li>
                    <label for="conf-mot-de-passe">Confirmer mot-de-passe*</label>
                    <input type="password" id="conf-mot-de-passe" class="label-input" name="conf-mot-de-passe" required>
                    <span id="password-error" class="error-text" style="display: none;">Les mots de passe ne correspondent pas.</span>
                </li>
                <li>
                    <input id="submit-input" type="submit" name="submit" value="créer un compte">
                </li>
            </ul>
        </form>
    </div>

    <hr id="midhr">

    <h2>Besoin d'assistance ?</h2>
    <div id="tel">
        <img src="assets/img/contact/icon-mobile.png" alt="">
        <h1 id="hPhone">
            Mobile :<br>
            <span><u>02 41 45 18 45</u></span>
        </h1>
        <p id="txtHorairesP">De Lundi à Samedi, entre 8h et 19h.</p>
    </div>
    
</div>

</body>
<?php
require_once './footer.html';
?>
</html>