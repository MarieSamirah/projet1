<?php
include_once 'Database.php';

// Connexion à la base de données
$database = new Database();
$pdo = $database->getConnection();

// Requête pour obtenir les communes et leurs fokontany
$query = "
    SELECT c.id_commune, c.nom_commune, f.id_fokontany, f.nom_fokontany 
    FROM Commune c 
    LEFT JOIN Fokontany f ON c.id_commune = f.id_commune
";
$stmt = $pdo->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Organiser les données par commune
$communes = [];
foreach ($results as $row) {
    $communes[$row['id_commune']]['nom_commune'] = $row['nom_commune'];
    $communes[$row['id_commune']]['fokontany'][] = [
        'id_fokontany' => $row['id_fokontany'],
        'nom_fokontany' => $row['nom_fokontany']
    ];
}

// Afficher les données
foreach ($communes as $id_commune => $commune) {
    echo "Commune : " . $commune['nom_commune'] . "<br>";
    echo "Fokontany associés :<br>";
    if (!empty($commune['fokontany'])) {
        foreach ($commune['fokontany'] as $fokontany) {
            echo "- " . $fokontany['nom_fokontany'] . "<br>";
        }
    } else {
        echo "Aucun fokontany pour cette commune.<br>";
    }
    echo "<br>";
}
?>
