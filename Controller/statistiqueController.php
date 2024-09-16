<?php
include "../Model/Database.php";
include "../Model/LivraisonFokontany.php";

if(isset($_POST['getTotalRecensement']))
{
    $database = new Database();
    $db = $database->getConnection();
    $recensementID = $_POST['recensement_id'];
    $livraisonfokontany = new LivraisonFokontany($db);
    $totals = $livraisonfokontany->getTotalLivraisonFokontany($recensementID);
    ?>
    <!-- Total recensement -->
    <div class="col-xl-2 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Nb recensement</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totals['total_recensement'] ?? 0 ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total recu -->
    <div class="col-xl-2 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total reçu</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totals['total_recu'] ?? 0 ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Distribué -->
    <div class="col-xl-2 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Distribué
                        </div>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $totals['total_distribue'] ?? 0 ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Doublon -->
    <div class="col-xl-2 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total doublon</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totals['total_doublon'] ?? 0 ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Autre anomalie -->
    <div class="col-xl-2 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Autre anomalie</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totals['total_anomalie'] ?? 0 ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reste à distribuer -->
    <div class="col-xl-2 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Reste à distribuer</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totals['total_reste_distribue'] ?? 0 ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
}

if(isset($_POST['getListe']))
{
    $database = new Database();
    $db = $database->getConnection();
    $region = $_POST['region_id'];
    $district = $_POST['district_id'];
    $commune = $_POST['commune_id'];
    $livraisonfokontany = new LivraisonFokontany($db);
    if($commune != "" ) $stmt = $livraisonfokontany->readByCommune($commune);
    else if($district != "") $stmt = $livraisonfokontany->readByDistrict($district);
    else if($region != "") $stmt = $livraisonfokontany->readByRegion($region);
    else $stmt = $livraisonfokontany->read();
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