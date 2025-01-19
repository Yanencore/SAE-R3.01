<?php

require_once 'app/User.php';
require_once 'app/UserBddMySQL.php';
require_once 'app/BddConnect.php';
$bdd = new BddConnect();
$pdo = $bdd->connexion();
$trousseau = new UserBddMySQL($pdo);

if (!$trousseau->isAdmin()) {
    header("Location: se-connecter.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | CADUS</title>
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <link rel="stylesheet" href="stylesheet/dashboard.css">
    <link rel="stylesheet" href="stylesheet/style.css">
    <script src="scripts/jquery.js"></script>
    <script src="scripts/menu.js"></script>
    <script src="scripts/data.js"></script>
</head>
<body>
<header></header>
<h1>Analyse des Sondages</h1>

<div id="global">
    <div class="chart" id="satisfaction-chart">
        <h2>Histogramme : Satisfaction</h2>
    </div>

    <div class="chart" id="sexe-chart">
        <h2>Camembert : Répartition des sexes</h2>
    </div>

    <div class="chart" id="region-chart">
        <h2>Histogramme : Répartition par Région</h2>
    </div>

    <div class="chart" id="habitat-chart">
        <h2>Histogramme : Type d'Habitat</h2>
    </div>
</div>
<footer></footer>
</body>
</html>

