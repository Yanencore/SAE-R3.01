<?php
require_once 'BddConnect.php';

class SondageAnalysis {
    private PDO $pdo;

    public function __construct() {
        $bddConnect = new BddConnect();
        $this->pdo = $bddConnect->connexion();
    }

    public function getSatisfactionData(): array {
        $stmt = $this->pdo->query("SELECT satisfaction, COUNT(*) as count FROM sondage GROUP BY satisfaction");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSexeData(): array {
        $stmt = $this->pdo->query("SELECT sexe, COUNT(*) as count FROM sondage GROUP BY sexe");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRegionData(): array {
        $stmt = $this->pdo->query("SELECT r.nom_region, COUNT(*) as count 
                                   FROM sondage s 
                                   JOIN regions r ON s.region_id = r.id 
                                   GROUP BY r.nom_region");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTypeHabitatData(): array {
        $stmt = $this->pdo->query("SELECT type_habitat, COUNT(*) as count FROM sondage GROUP BY type_habitat");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getActiviteProfessionnelleData(): array {
        $stmt = $this->pdo->query("SELECT activite_professionnelle, COUNT(*) as count 
                                   FROM sondage GROUP BY activite_professionnelle");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

header('Content-Type: application/json');

$analysis = new SondageAnalysis();

$type = $_GET['type'] ?? '';

switch ($type) {
    case 'satisfaction':
        echo json_encode($analysis->getSatisfactionData());
        break;
    case 'sexe':
        echo json_encode($analysis->getSexeData());
        break;
    case 'region':
        echo json_encode($analysis->getRegionData());
        break;
    case 'habitat':
        echo json_encode($analysis->getTypeHabitatData());
        break;
    case 'activite':
        echo json_encode($analysis->getActiviteProfessionnelleData());
        break;
    default:
        echo json_encode(['error' => 'Invalid type parameter']);
        break;
}
