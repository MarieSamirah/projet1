<?php
include "../Model/Database.php";
include "../Model/District.php";
include "../Model/Commune.php";

if(isset($_POST['region_id'])){
    $database = new Database();
    $db = $database->getConnection();

    $district = new District($db);
    $stmt = $district->readByRegion($_POST['region_id']); // Fonction à ajouter dans la classe District
    
    if($stmt->rowCount() > 0){
        echo '<option value="">Choisir district</option>';
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            echo "<option value={$id}>{$nom}</option>";
        }
    }else{
        echo '<option value="">Pas de districts disponibles</option>';
    }
}

if(isset($_POST['district_id'])){
    $database = new Database();
    $db = $database->getConnection();

    $commune = new Commune($db);
    $stmt = $commune->readByDistrict($_POST['district_id']);
    
    if($stmt->rowCount() > 0){
        echo '<option value="">Choisir commune</option>';
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            echo "<option value={$id}>{$nom}</option>";
        }
    }else{
        echo '<option value="">Pas de districts disponibles</option>';
    }
}
?>
