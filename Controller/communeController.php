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

if(isset($_POST['getListe']))
{
    $database = new Database();
    $db = $database->getConnection();

    $commune = new Commune($db);
    $regionID = $_POST['region_id'];
    $districtID = $_POST['district_id'];

    if($districtID != "") $stmt = $commune->readJoinByDistrict($districtID);
    else if($regionID != "") $stmt = $commune->readJoinByRegion($regionID);
    else $stmt = $commune->readJoin();
    ?>
    <table class="table table-bordered" id="dataTableNouveau" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Commune</th>
                <th>District</th>
                <th>Région</th>
                <th class='text-center'>Nb Fokontany</th>
                <th class='text-center'>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $num = $stmt->rowCount();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                echo "<tr>";
                echo "<td>{$commune_nom}</td>";
                echo "<td>{$district_nom}</td>";
                echo "<td>{$region_nom}</td>";
                echo "<td class='text-center'>{$compte_fokontany}</td>";
                echo "<td class='text-center'>";
                echo "<a href='javascript:prepareUpdate({$commune_id}, {$region_id}, {$district_id}, `{$commune_nom}`)'><i class='fas fa-edit text-warning'></i></a> ";
                echo "<a href='javascript:prepareDelete({$commune_id}, `{$commune_nom}`)'><i class='fas fa-trash text-danger'></i> </a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>

        </tbody>
    </table>
    <?php
}
?>