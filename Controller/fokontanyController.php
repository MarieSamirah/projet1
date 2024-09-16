<?php
include "../Model/Database.php";
include "../Model/Fokontany.php";

if(isset($_POST['ajouter']))
{
    $database = new Database();
    $db = $database->getConnection();

    $fokontany = new Fokontany($db);
    $fokontany->nom = $_POST['nom'];
    $fokontany->nom_chef = $_POST['nom_chef'];
    $fokontany->contact = $_POST['contact'];
    $fokontany->communeID = $_POST['commune'];

    if ($fokontany->create()) {
        header("Location: ../View/fokontany.php");
        exit();
    }
}

if(isset($_POST['modifier']))
{
    $database = new Database();
    $db = $database->getConnection();

    $fokontany = new Fokontany($db);
    $fokontany->id = $_POST['id'];
    $fokontany->nom = $_POST['nom'];
    $fokontany->nom_chef = $_POST['nom_chef'];
    $fokontany->contact = $_POST['contact'];

    if ($fokontany->update()) {
        header("Location: ../View/fokontany.php");
        exit();
    }
}

if(isset($_POST['supprimer']))
{
    $database = new Database();
    $db = $database->getConnection();

    $fokontany = new Fokontany($db);
    $fokontany->id = $_POST['id'];

    if ($fokontany->delete()) {
        header("Location: ../View/fokontany.php");
        exit();
    }
}

if(isset($_POST['getListe']))
{
    $database = new Database();
    $db = $database->getConnection();

    $fokontany = new Fokontany($db);
    $regionID = $_POST['region_id'];
    $districtID = $_POST['district_id'];
    $communeID = $_POST['commune_id'];

    if($communeID != "") $stmt = $fokontany->readJoinByCommune($communeID);
    else if($districtID != "") $stmt = $fokontany->readJoinByDistrict($districtID);
    else if($regionID != "") $stmt = $fokontany->readJoinByRegion($regionID);
    else $stmt = $fokontany->readJoin();
    ?>
    <table class="table table-bordered" id="dataTableNouveau" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Fokontany</th>
                <th>Chef du Fokontany</th>
                <th class='text-center'>Contact</th>
                <th>Commune</th>
                <th>District</th>
                <th>Région</th>
                <th class='text-center'>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $num = $stmt->rowCount();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                echo "<tr>";
                echo "<td>{$fokontany_nom}</td>";
                echo "<td>{$chef}</td>";
                echo "<td class='text-center'>{$contact}</td>";
                echo "<td>{$commune_nom}</td>";
                echo "<td>{$district_nom}</td>";
                echo "<td>{$region_nom}</td>";
                echo "<td class='text-center'>";
                echo "<a href='javascript:prepareUpdate({$fokontany_id}, `{$fokontany_nom}`, `{$chef}`, `{$contact}`)'><i class='fas fa-edit text-warning'></i></a> ";
                echo "<a href='javascript:prepareDelete({$fokontany_id} , `{$fokontany_nom}`)'><i class='fas fa-trash text-danger'></i> </a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <?php
}

?>