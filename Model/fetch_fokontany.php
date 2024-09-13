<?php
include_once "../Model/Database.php";
include_once "../Model/Fokontany.php";

if (isset($_GET['commune_id'])) {
    $communeID = $_GET['commune_id'];
    
    // Instancier la connexion à la base de données
    $database = new Database();
    $db = $database->getConnection();
    
    // Instancier le modèle Fokontany
    $fokontany = new Fokontany($db);
    
    // Récupérer les fokontany pour la commune donnée
    $stmt = $fokontany->getFokontanyByCommune($communeID);
    $num = $stmt->rowCount();
    
    if ($num > 0) {
        echo "<table class='table table-bordered'>";
        echo "<thead><tr><th>ID</th><th>Nom</th></tr></thead>";
        echo "<tbody>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            echo "<tr><td>{$id}</td><td>{$nom}</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Aucun fokontany trouvé pour cette commune.</p>";
    }
} else {
    echo "<p>ID de la commune non spécifié.</p>";
}
?>
