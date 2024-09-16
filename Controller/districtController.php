<?php
include "../Model/Database.php";
include "../Model/District.php";

if(isset($_POST['ajouter']))
{
    $database = new Database();
    $db = $database->getConnection();

    $district = new District($db);
    $district->nom = $_POST['nom'];
    $district->regionID = $_POST['region'];

    if ($district->create()) {
        header("Location: ../View/district.php");
        exit();
    }
}

if(isset($_POST['modifier']))
{
    $database = new Database();
    $db = $database->getConnection();

    $district = new District($db);
    $district->id = $_POST['id'];
    $district->nom = $_POST['nom'];
    $district->regionID = $_POST['region'];

    if ($district->update()) {
        header("Location: ../View/district.php");
        exit();
    }
}

if(isset($_POST['supprimer']))
{
    $database = new Database();
    $db = $database->getConnection();

    $district = new District($db);
    $district->id = $_POST['id'];

    if ($district->delete()) {
        header("Location: ../View/district.php");
        exit();
    }
}

if(isset($_POST['getListe']))
{
    $database = new Database();
    $db = $database->getConnection();

    $district = new District($db);
    $regionID = $_POST['region_id'];

    if($regionID != "") $stmt = $district->readJoinByRegion($regionID);
    else $stmt = $district->readJoin();
    ?>
    <table class="table table-bordered" id="dataTableNouveau" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>District</th>
                <th>Région</th>
                <th class='text-center'>Commune</th>
                <th class='text-center'>Fokontany</th>
                <th class='text-center'>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $num = $stmt->rowCount();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                echo "<tr>";
                echo "<td>{$district_nom}</td>";
                echo "<td>{$region_nom}</td>";
                echo "<td class='text-center'>{$compte_commune}</td>";
                echo "<td class='text-center'>{$compte_fokontany}</td>";
                echo "<td class='text-center'>";
                echo "<a href='javascript:prepareUpdate({$district_id}, {$region_id}, `{$district_nom}`)'><i class='fas fa-edit text-warning'></i></a> ";
                echo "<a href='javascript:prepareDelete({$district_id}, `{$district_nom}`)'><i class='fas fa-trash text-danger'></i> </a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>

        </tbody>
    </table>
    <?php
}
?>