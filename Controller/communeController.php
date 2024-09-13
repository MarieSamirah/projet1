<?php
include "../Model/Database.php";
include "../Model/Commune.php";

if(isset($_POST['ajouter']))
{
    $database = new Database();
    $db = $database->getConnection();

    $commune = new Commune($db);
    $commune->nom = $_POST['nom'];
    $commune->districtID = $_POST['district'];

    if ($commune->create()) {
        header("Location: ../View/commune.php");
        exit();
    }
}

if(isset($_POST['modifier']))
{
    $database = new Database();
    $db = $database->getConnection();

    $commune = new Commune($db);
    $commune->id = $_POST['id'];
    $commune->nom = $_POST['nom'];
    $commune->districtID = $_POST['district'];

    if ($commune->update()) {
        header("Location: ../View/commune.php");
        exit();
    }
}

if(isset($_POST['supprimer']))
{
    $database = new Database();
    $db = $database->getConnection();

    $commune = new Commune($db);
    $commune->id = $_POST['id'];

    if ($commune->delete()) {
        header("Location: ../View/commune.php");
        exit();
    }
}
// Vérifier si l'ID de la commune est envoyé
if(isset($_POST['communeID'])) {
    $communeID = $_POST['communeID'];

    // Connexion à la base de données
    $database = new Database();
    $db = $database->getConnection();

    // Récupérer les fokontany pour la commune sélectionnée
    $query = "SELECT id, nom_fokontany FROM Fokontany WHERE commune_id = :communeID";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':communeID', $communeID, PDO::PARAM_INT);
    $stmt->execute();

    $fokontany = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retourner la liste des fokontany en JSON
    echo json_encode($fokontany);
}
?>