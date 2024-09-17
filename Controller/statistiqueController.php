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

if(isset($_POST['getStatByRegion']))
{
    $database = new Database();
    $db = $database->getConnection();
    $recensementID = $_POST['recensement_id'];
    $livraisonfokontany = new LivraisonFokontany($db);
    $stmt = $livraisonfokontany->getSumByRegion($recensementID);
    ?>
    <table class="table table-bordered table-smM" id="dataTableNouveau" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Region</th>
                <th>Nombre recensement</th>
                <th>Nombre carnet recu</th>
                <th>Nombre distribue</th>
                <th>Nombre reste distribue</th>
            </tr>
        </thead>
        <tbody> 
            <?php
            $num = $stmt->rowCount();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row); ?>
                <tr>
                    <td><?= $region_nom ?? 0 ?></td>
                    <td class='text-right'><?= $total_recensement ?? 0 ?></td>
                    <td class='text-right'><?= $total_recu ?? 0 ?></td>
                    <td class='text-right'><?= $total_distribue ?? 0 ?></td> 
                    <td class='text-right'><?= $total_reste_distribue ?? 0 ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}

?>