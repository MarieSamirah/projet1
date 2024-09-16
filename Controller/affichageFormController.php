<?php
include "../Model/Database.php";
include "../Model/District.php";
include "../Model/Commune.php";
include "../Model/Fokontany.php";

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
        echo '<option value="">Pas de Districts disponible</option>';
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
        echo '<option value="">Pas de Commune disponible</option>';
    }
}

if(isset($_POST['commune_id'])){
    $database = new Database();
    $db = $database->getConnection();

    $fokontany = new Fokontany($db);
    $stmt = $fokontany->readByCommune($_POST['commune_id']);
    
    if($stmt->rowCount() > 0){
        echo '<option value="">Choisir Fokontany</option>';
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            echo "<option value={$id}>{$nom}</option>";
        }
    }else{
        echo '<option value="">Pas de Fokontany disponible</option>';
    }
}
?>
