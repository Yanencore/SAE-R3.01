<?php
require_once './header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | CADUS</title>
    <link rel="stylesheet" href="assets/css/contact.css">
</head>
<body>
<div id="contact-nous"><h1>Contactez nous</h1></div>

<div id="formulaire-contact">

    <form>
        <ul>
            <div class="infos-persos">
                <li>
                    <label for="lastname">Nom*</label> <br>
                    <input type="text" id="lastname" placeholder="Dupont">
                </li>
                <li>
                    <label for="firstname">Prénom*</label> <br>
                    <input type="text" id="firstname" placeholder="Jean">
                </li>
            </div>
            <div class="infos-persos">
                <li>
                    <label for="email">Email*</label> <br>
                    <input type="text" id="email" placeholder="jeandupont@gmail.com">
                </li>
                <li>
                    <label for="phone">Téléphone</label> <br>
                    <input type="tel" id="phone" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}">
                </li>
            </div>

        </ul>

        <div id="mail-content">
            <ul>
                <li>
                    <label>Sujet</label> <br>
                    <select name="Sujet" id="subject ">
                        <option value="RDV">Demande de rendez-vous</option>
                        <option value="Jur">Conseil juridique</option>
                        <option value="med">Aide pour le dossier médical</option>
                        <option value="autre">Autre</option>
                    </select>
                </li>
                <li>
                    <label>Votre message</label> <br>
                    <textarea name="message" id="message-content"></textarea>
                </li>
                <li>
                    <button type="submit">
                        <img src="assets/img/contact/arrow.png" alt="Envoyer" id="#Btn-send">
                    </button>
                </li>
            </ul>
        </div>

    </form>
</div>

<div id="tel-adresse">
    <div class="tel-adresse-carte">
        <img src="assets/img/contact/icon-mobile.png" alt="">
        <h1 id="hPhone">
            Mobile :<br>
            <span><u>02 41 45 18 45</u></span>
        </h1>
        <p id="txtHorairesP">De Lundi à Samedi, entre 8h et 19h.</p>
    </div>
    <hr>
    <div class="tel-adresse-carte">
        <img src="assets/img/contact/icon-batiment.png" alt="">
        <h1 id="hLocation">
            Adresse : <br>
            <span> <u>8, rue Jean Giono, 49100 Angers</u></span>
        </h1>
        <p id="txtHorairesL">De Lundi à Samedi, entre 8h et 19h.</p>
    </div>
</div>
</body>
<?php
require_once './footer.html';
?>
</html>