<?php include "header.php" ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Région</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Nouvelle région</a> -->
</div>

<div class="row">
    <!-- Liste region  -->
    <?php
    $database = new Database();
    $db = $database->getConnection();
    $region = new Region($db);
    $stmt = $region->readJoin();
    $num = $stmt->rowCount();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        ?>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-gray-700"><?php echo "{$region_nom}" ?></h6>
                    <!-- <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Action:</div>
                            <a class="dropdown-item" href="#">Modifier</a>
                            <a class="dropdown-item" href="#">Supprimer</a>
                        </div>
                    </div> -->
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-info text-uppercasee">
                        <a href="" class="card-link text-gray-600 mb-4">District : <?php echo "{$compte_district}"  ?></a>
                        <br>
                        <a href="" class="card-link text-gray-600 mb-4">Commune: <?php echo "{$compte_commune}" ?></a>
                        <br>
                        <a href="" class="card-link text-gray-600 mb-4">Fokontany: <?php echo "{$compte_fokontany}"  ?></a>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php } ?>
</div>

<?php include "footer.php" ?>
<script>
    $("#departementItem").addClass("active");
    $("#regionItem").addClass("active");
</script>