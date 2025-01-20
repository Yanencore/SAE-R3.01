<?php
require_once 'BddConnect.php';
require_once 'UserBddMySQL.php';
$bdd = new BddConnect();
$pdo = $bdd->connexion();
$trousseau = new UserBddMySQL($pdo);

//surveyData.php récupère les données du formulaire et les enregistre dans la base de données.

if (!$trousseau->isUserConnected()){
    header("Location: ../se-connecter.php");
    exit();
}

if ($trousseau->didTheSurvey()) {
    header("Location: ../mon-espace.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    var_dump($_POST);

    $age = $_POST['age'] ?? null;
    $sexe = $_POST['sexe'] ?? null;
    $region_id = $_POST['nom_region'] ?? null;
    $type_habitat = $_POST['type_habitat'] ?? null;
    $cdaph_orientation = isset($_POST['cdaph']) && $_POST['cdaph'] === 'oui' ? 1 : 0;
    $choix_vie = isset($_POST['choix_vie']) && $_POST['choix_vie'] === 'oui' ? 1 : 0;
    $activite_professionnelle = isset($_POST['emploi']) && $_POST['emploi'] === 'oui' ? 1 : 0;
    $type_activite_id = $_POST['type_activite'] ?? null;
    $activite_sociale = isset($_POST['activite_sociale']) && $_POST['activite_sociale'] === 'oui' ? 1 : 0;
    $description_sociale = $_POST['activite_sociale_desc'] ?? null;
    $satisfaction = $_POST['satisfaction'] ?? null;
    $soutien = isset($_POST['soutien']) && $_POST['soutien'] === 'oui' ? 1 : 0;
    $description_soutien = $_POST['soutien_precision'] ?? null;
    $user_id = $trousseau->getUserId();

    try {

        $stmtRegion = $pdo->query("SELECT id FROM regions WHERE nom_region = '$region_id'");
        $region = $stmtRegion->fetch();
        if (!$region) {
            die("La région spécifiée n'existe pas.");
        }
        $region_id = $region['id'];

        if ($type_activite_id != null){
            $stmtActivite = $pdo->query("SELECT id FROM types_activite WHERE nom_type_activite = '$type_activite_id'");
            $activite = $stmtActivite->fetch();
            if (!$activite) {
                die("Le type d'activité spécifié n'existe pas.");
            }
            $type_activite_id = $activite['id'];
        }



        $stmt = $pdo->prepare("
                INSERT INTO sondage (
                age, sexe, region_id, type_habitat, cdaph_orientation, choix_vie, 
                activite_professionnelle, type_activite_id, activite_sociale, 
                satisfaction, soutien, description_activite_sociale, description_soutien, user_id) 
                VALUES (
                :age, :sexe, :region_id, :type_habitat, :cdaph_orientation, :choix_vie, 
                :activite_professionnelle, :type_activite_id, :activite_sociale, 
                :satisfaction, :soutien, :description_sociale, :description_soutien, :user_id)");


        $stmt->execute([
            ':age' => $age,
            ':sexe' => $sexe,
            ':region_id' => $region_id,
            ':type_habitat' => $type_habitat,
            ':cdaph_orientation' => $cdaph_orientation,
            ':choix_vie' => $choix_vie,
            ':activite_professionnelle' => $activite_professionnelle,
            ':type_activite_id' => $type_activite_id,
            ':activite_sociale' => $activite_sociale,
            ':satisfaction' => $satisfaction,
            ':soutien' => $soutien,
            ':description_sociale' => $description_sociale,
            ':description_soutien' => $description_soutien,
            ':user_id' => $user_id,
        ]);

        echo "Les données ont été enregistrées avec succès.";
    } catch (PDOException $e) {
        echo "Erreur lors de l'enregistrement : " . $e->getMessage();
    }
}

