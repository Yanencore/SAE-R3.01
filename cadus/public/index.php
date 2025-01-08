<?php
require_once './header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil | CADUS</title>
    <link rel="stylesheet" href="assets/css/accueil.css">
</head>
<body>
<div id="imageEntreprise">
    <img src="assets/img/accueil/pixelcut-export.png" alt="image-entreprise">
</div>

<div id="quiSommesNous">
    <h1><a href="association.php">Qui sommes nous ?</a></h1>
    <p>L'association CADUS-CONSEIL AIDE DEFENSE DES USAGERS DE LA SANTE a été crée le 31 mai 2005, il y a 19 ans. Sa
        forme juridique est une Association déclarée.</p>
</div>

<div id="conseilAide">
    <ul>
        <li>Conseil Aide et défense des Usagers de la Santé sur le plan juridique et judiciaire.</li>
        <li>Aide à obtenir votre dossier médical.</li>
        <li>Aide à la constitution de votre demande d'indemnisation.</li>
        <li>Conseils tout au long de votre parcours jusqu'à l'indemnisation</li>
    </ul>
</div>

<div id="cartesLiens">
    <div class="carte">
        <img src="assets/img/accueil/icon_balance.png" alt="icon_balance">
        <a href="">Mentions</a>
    </div>
    <div class="carte">
        <img src="assets/img/accueil/icon_aide.png" alt="icon_aide">
        <a href="">Nous Aider</a>
    </div>
    <div class="carte">
        <img src="assets/img/accueil/icon_livre.png" alt="icon_livre">
        <a href="">Livre d'or</a>
    </div>
</div>

<div id="collaborateurs">
    <div id="collabTitle">
        <h1>Nos collaborations</h1>
    </div>
    <div id="collabs">
        <a href="https://paysdelaloire.france-assos-sante.org/">
            <img id="fas" src="assets/img/accueil/logo_repertoire_FAS_modifie.png" alt="image_france_assos_sante">
        </a>
        <a href="https://www.paysdelaloire.fr/">
            <img id="pLoire" src="assets/img/accueil/logo_pays-de-la-loire_2022.png" alt="image_pays_de_loire">
        </a>
        <a href="https://prescrire.org/Fr/1/507/49248/3234/ReportDetails.aspx">
            <img id="medEu" src="assets/img/accueil/pixelcut-export__1_-removebg-preview.png"
                 alt="image_medicines_in_europe">
        </a>
    </div>
</div>
</body>
<?php
require_once './footer.html';
?>
</html>