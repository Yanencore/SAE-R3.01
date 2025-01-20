<?php
if (!session_id()) {
    session_start();
}
$logError = $_SESSION['errors']['logIn'] ?? null;
unset($_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CADUS | Sign in</title>
    <link rel="stylesheet" href="stylesheet/style.css">
    <link rel="stylesheet" href="stylesheet/se-connecter.css">
    <script src="scripts/jquery.js"></script>
    <script src="scripts/menu.js"></script>
    <script src="scripts/formSignIn.js"></script>
</head>
<body>
  <header></header>
  <div id="global">
    <h1 id="hSeConnecter">Se connecter</h1>
    <div id="formConnexion">
      <form method="post" action="app/logIn.php">
        <ul>
          <li>
            <label>Email</label>
            <input type="email" id="mail" class="label-input" name="email" placeholder="" required>
          </li>
          <li>
            <label>Mot-de-Passe</label>
            <input type="password" id="mot-de-passe" class="label-input" name="mot-de-passe" required>
              <?php if ($logError): ?>
                  <span class="error-text"><?=htmlspecialchars($logError)?></span>
              <?php endif; ?>
          </li>
          <li>
            <a href=""><u>mot de passe oublié ?</u></a>
          </li>
          <li>
              <input type="checkbox" id="showPswd"/>
              <label>Afficher le mot de passe</label>
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
          <img src="img/ce_qu_il_faut_savoir/more.png" alt="">
        </button>
      </a>
    </div>

  </div>
  <footer></footer>
</body>
</html>