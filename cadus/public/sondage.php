<?php
require_once '../app/User.php';
require_once '../app/UserBddMySQL.php';
require_once '../app/BddConnect.php';
$bdd = new BddConnect();
$pdo = $bdd->connexion();
$trousseau = new UserBddMySQL($pdo);

if (!$trousseau->isUserConnected()){
    header("Location: se-connecter.php");
    exit();
}
require_once './header.php';

if ($trousseau->didTheSurvey()){
    header("Location: mon-espace.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sondage</title>
    <link rel="stylesheet" href="assets/css/sondage.css">
    <script src="assets/js/sondage.js"></script>
</head>

<body>
    <div id="global">
        <h1>Sondage</h1>
        <form action="surveyData.php" method="post">
            <!-- Qui a répondu à l’enquête ? -->
            <fieldset class="form-step active">
                <h2>1. Vôtre situation</h2>

                <label for="age">Âge :</label>
                <input type="number" id="age" name="age" min="18" max="100" required><br><br>

                <label for="sexe">Sexe :</label>
                <select id="sexe" name="sexe">
                    <option value="homme">Homme</option>
                    <option value="femme">Femme</option>
                    <option value="autre">Autre</option>
                </select> <br> <br>

                <!-- Lieu de vie -->

                <label for="Region">Ville :</label>
                <select id="Region" name="nom_region">
                    <option value="Auvergne Rhone-Alpes">Auvergne Rhône-Alpes</option>
                    <option value="Bourgogne Franche-Comte">Bourgogne Franche-Comté</option>
                    <option value="Bretagne">Bretagne</option>
                    <option value="Contre-Val-de-Loire">Contre-Val-de-Loire</option>
                    <option value="Corse">Corse</option>
                    <option value="Grand-Est">Grand-Est</option>
                    <option value="Hauts-de-France">Hauts-de-France</option>
                    <option value="Ile-de-France">Ile-de-France</option>
                    <option value="Normandie">Normandie</option>
                    <option value="Nouvelle-Aquitaine">Nouvelle-Aquitaine</option>
                    <option value="Occitanie">Occitanie</option>
                    <option value="Pays de la Loire">Pays de la Loire</option>
                    <option value="Provence-Alpes-Cote d'Asur">Provence-Alpes-Côte d'Asur</option>
                    <option value="Guadeloupe">Guadeloupe</option>
                    <option value="Guyane">Guyane</option>
                    <option value="Martinique">Martinique</option>
                    <option value="Mayotte">Mayotte</option>
                    <option value="La Reunion">La Réunion</option>
                    <option value="Etranger">Je vis à l'étranger</option>
                </select>

                <label for="type_habitat">Type d'habitat :</label>
                <select id="type_habitat" name="type_habitat">
                    <option value="appartement">Appartement</option>
                    <option value="maison">Maison</option>
                    <option value="autre">Autre</option>
                </select> <br> <br>

                <label>Le lieu de vie correspond-il à une orientation CDAPH ?</label> <br>
                <input type="radio" id="cdaph_oui" name="cdaph" value="oui" required>
                <label for="cdaph_oui">Oui</label><br>
                <input type="radio" id="cdaph_non" name="cdaph" value="non">
                <label for="cdaph_non">Non</label><br><br>

                <label>Le lieu de vie correspond-il à votre choix ?</label> <br>
                <input type="radio" id="choix_vie_oui" name="choix_vie" value="oui" required>
                <label for="choix_vie_oui">Oui</label><br>
                <input type="radio" id="choix_vie_non" name="choix_vie" value="non">
                <label for="choix_vie_non">Non</label>
            </fieldset>

            <!-- Insertion professionnelle et sociale -->
            <fieldset class="form-step">
                <h2>2. Insertion professionnelle et sociale</h2>
                <label>Avez-vous une activite professionnelle ou scolaire ?</label><br>
                <input type="radio" id="emploi_oui" name="emploi" value="oui" onclick="const field = document.getElementById('type_activite'); field.disabled = false;" required>
                <label for="emploi_oui">Oui</label><br>
                <input type="radio" id="emploi_non" name="emploi" value="non" onclick="const field = document.getElementById('type_activite'); field.disabled = true;">
                <label for="emploi_non">Non</label><br><br>

                <label for="type_activite">Type d'activité :</label>
                <select id="type_activite" name="type_activite" disabled>
                    <option value="Scolarite en milieu ordinaire">Scolarité en milieu ordinaire</option>
                    <option value="Scolarite en dispositif specialise de l'education nationale">Scolarité en dispositif spécialisé de l'éducation nationale</option>
                    <option value="Instruction en famille">Instruction en famille</option>
                    <option value="Scolarite dans une etablissement medico-social">Scolarité dans une établissement médico-social (IME, IMPRO...)</option>
                    <option value="Formation professionnelle">Formation professionnelle</option>
                    <option value="Etudes supérieures">Etudes supérieures</option>
                    <option value="Activite professionnelle en milieu ordinaire">Activité professionnelle en milieu ordinaire</option>
                    <option value="Activite professionnelle en milieu protege">Activité professionnelle en milieu protegé</option>
                    <option value="Autre">Autre</option>

                </select> <br> <br>

                <label for="activite_sociale">Participez-vous à des activités sociales ?</label><br>
                <input type="radio" id="activite_sociale_oui" name="activite_sociale" value="oui" onclick="const field = document.getElementById('activite_sociale'); field.disabled = false;" required>
                <label for="activite_sociale_oui">Oui</label><br>
                <input type="radio" id="activite_sociale_non" name="activite_sociale" value="non" onclick="const field = document.getElementById('activite_sociale'); field.disabled = true;">
                <label for="activite_sociale_non">Non</label><br><br>
                <textarea id="activite_sociale" name="activite_sociale_desc" rows="8" cols="63" placeholder="Décrivez vos activités..." disabled></textarea>
            </fieldset>

            <!-- Qualité de vie -->
            <fieldset class="form-step">
                <h2>3. Qualité de vie</h2>
                <label for="satisfaction">Sur une échelle de 1 à 10, comment évaluez-vous votre qualité de vie ?</label>
                <br>
                <br>
                <br>
                <input type="number" id="satisfaction" name="satisfaction" min="1" max="10" required>
            </fieldset>

            <!-- Besoin de soutien -->
            <fieldset class="form-step">
                <h2>4. Besoin de soutien</h2>
                <label >Avez-vous besoin d'un soutien ?</label><br>
                <input type="radio" id="soutien_oui" name="soutien" value="oui" onclick="const field = document.getElementById('soutien_precision'); field.disabled = false;" required>
                <label for="soutien_oui">Oui</label><br>
                <input type="radio" id="soutien_non" name="soutien" value="non" onclick="const field = document.getElementById('soutien_precision'); field.disabled = true; field.value = '';">
                <label for="soutien_non">Non</label><br><br>
                <label for="soutien_precision">Quels sont vos besoins en matière de soutien ?</label><br>
                <textarea id="soutien_precision" name="soutien_precision" rows="8" cols="63" placeholder="Décrivez vos besoins..." disabled></textarea>
            </fieldset>


            <div class="form-navigation">
                <button type="button" id="btnRetour">Retour</button>
                <button type="button" id="btnSuivant">Suivant</button>
                <button type="submit" class="hidden">Envoyer</button>
            </div>

        </form>

        <a href="mon-espace.php">
            <button id="btnExit">
                <img src="assets/img/sondage/croix.png" alt="sortir">
            </button>
        </a>
    </div>
</body>
</html>
