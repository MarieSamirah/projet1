<?php
header('Content-Type: application/json');
include '../Model/Database.php';
include '../Model/LivraisonFokontany.php';

$database = new Database();
$db = $database->getConnection();

$livraisonfokontany = new LivraisonFokontany($db);

if (isset($_GET['commune_id'])) {
    $communeId = $_GET['commune_id'];
    $stmt = $livraisonfokontany->readByCommune($communeId);
    $fokontany = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $fokontany[] = $row;
    }

    echo json_encode(['success' => true, 'fokontany' => $fokontany]);
} else {
    echo json_encode(['success' => false, 'message' => 'Commune ID is missing']);
}
?>
