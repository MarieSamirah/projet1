<?php
include "../Model/Database.php";
include "../Model/LivraisonFokontany.php";

if(isset($_POST['ajouter']))
{
    $database = new Database();
    $db = $database->getConnection();

    $livraisonfokontany = new LivraisonFokontany($db);
    $livraisonfokontany->nombre_recensement = $_POST['nombre_recensement'];
    $livraisonfokontany->nombre_recu = $_POST['nombre_recu'];
    $livraisonfokontany->nombre_doublon = $_POST['nombre_doublon'];
    $livraisonfokontany->nombre_distribue = $_POST['nombre_distribue'];
    $livraisonfokontany->nombre_reste_distribue = $_POST['nombre_reste_distribue'];
    $livraisonfokontany->nombre_autre_anomalie = $_POST['nombre_autre_anomalie'];
    $livraisonfokontany->date_livraison= $_POST['date_livraison'];
    $livraisonfokontany->fokontanyID= $_POST['fokontanyID'];
    $livraisonfokontany->recensementID= $_POST['recensementID'];
    $livraisonfokontany->observation= $_POST['observation'];

    if ($livraisonfokontany->create()) {
        header("Location: ../View/livraisonFokontany.php");
        exit();
    }
}
if(isset($_POST['modifier']))
{
    $database = new Database();
    $db = $database->getConnection();

    $livraisonfokontany = new LivraisonFokontany($db);
    $livraisonfokontany->nombre_recensement = $_POST['nombre_recensement'];
    $livraisonfokontany->nombre_recu = $_POST['nombre_recu'];
    $livraisonfokontany->nombre_doublon = $_POST['nombre_doublon'];
    $livraisonfokontany->nombre_distribue = $_POST['nombre_distribue'];
    $livraisonfokontany->nombre_reste_distribue = $_POST['nombre_reste_distribue'];
    $livraisonfokontany->nombre_autre_anomalie = $_POST['nombre_autre_anomalie'];
    $livraisonfokontany->date_livraison= $_POST['date_livraison'];
    $livraisonfokontany->fokontanyID= $_POST['fokontanyID'];
    $livraisonfokontany->observation= $_POST['observation'];
    $livraisonfokontany->id = $_POST['id'];
    if ($livraisonfokontany->update()) {
        header("Location: ../View/livraisonFokontany.php");
        exit();
    }
}

if(isset($_POST['supprimer']))
{
    $database = new Database();
    $db = $database->getConnection();

    $livraisonfokontany= new LivraisonFokontany($db);
    $livraisonfokontany->id = $_POST['id'];

    if ($livraisonfokontany->delete()) {
        header("Location: ../View/livraisonFokontany.php");
        exit();
    }
}

if(isset($_POST['getListe']))
{
    $database = new Database();
    $db = $database->getConnection();
    $region = $_POST['region_id'];
    $district = $_POST['district_id'];
    $commune = $_POST['commune_id'];
    $recensement = $_POST['recensement_id'];
    $livraisonfokontany = new LivraisonFokontany($db);
    if($commune != "" ) $stmt = $livraisonfokontany->readByCommune($recensement, $commune);
    else if($district != "") $stmt = $livraisonfokontany->readByDistrict($recensement, $district);
    else if($region != "") $stmt = $livraisonfokontany->readByRegion($recensement, $region);
    else $stmt = $livraisonfokontany->read($recensement);
    ?>
    <table class="table table-bordered table-smM" id="dataTableNouveau" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>fokontany</th>
                <th>Date livraison</th>
                <th>Nombre recensement</th>
                <th>Nombre carnet recu</th>
                <th>Nombre doublon</th>
                <th>Nombre Anomalie</th>
                <th>Nombre distribue</th>
                <th>Nombre reste distribue</th>
                <th>Observation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody> 
            <?php
            $num = $stmt->rowCount();
            $total_recensement = 0;
            $total_recu = 0;
            $total_doublon = 0;
            $total_anomalie = 0;
            $total_distribue = 0;
            $total_reste_distribue = 0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $total_recensement += $nombre_recensement;
                $total_recu += $nombre_recu;
                $total_doublon += $nombre_doublon;
                $total_anomalie += $nombre_autre_anomalie;
                $total_distribue += $nombre_distribue;
                $total_reste_distribue += $nombre_reste_distribue;
                $fokontanyName = $livraisonfokontany->getFokontanyName($fokontanyID);
                echo "<tr>";
                echo "<td>{$fokontanyName}</td>";
                echo "<td class='text-center'>{$date_livraison}</td>";
                echo "<td class='text-right'>{$nombre_recensement}</td>";
                echo "<td class='text-right'>{$nombre_recu}</td>";
                echo "<td class='text-right'>{$nombre_doublon}</td>";
                echo "<td class='text-right'>{$nombre_autre_anomalie}</td>"; 
                echo "<td class='text-right'>{$nombre_distribue}</td>"; 
                echo "<td class='text-right'>{$nombre_reste_distribue}</td>";
                echo "<td>{$observation}</td>";
                echo "<td>";
                echo "<a href='javascript:prepareUpdate({$id}, `{$nombre_recensement}`, `{$nombre_recu}`, `{$nombre_doublon}`, `{$nombre_distribue}`, `{$nombre_reste_distribue}`, `{$nombre_autre_anomalie}`, `{$date_livraison}`, `{$fokontanyID}`, `{$observation}`)'><i class='fas fa-edit text-warning'></i></a> ";
                echo "<a href='javascript:prepareDelete({$id}, `{$fokontanyName}`)'><i class='fas fa-trash text-danger'></i></a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">Total</th>
                <td id="totalRecensement" class='text-right'><?= $total_recensement ?></td>
                <td id="totalRecu" class='text-right'><?= $total_recu ?></td>
                <td id="totalDoublon" class='text-right'><?= $total_doublon ?></td>
                <td id="totalAnomalie" class='text-right'><?= $total_anomalie ?></td>
                <td id="totalDistribue" class='text-right'><?= $total_distribue ?></td>
                <td id="totalResteDistribue" class='text-right'><?= $total_reste_distribue ?></td>
                <td></td> <!-- Empty for Date -->
                <td></td> <!-- Empty for fokontanyID -->
                
            </tr>
        </tfoot>
        </table>
    <?php
}

?>