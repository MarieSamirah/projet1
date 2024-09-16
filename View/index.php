<?php include "header.php";?>

<!-- Page Heading -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h5 class="m-0 font-weight-bold text-primary">Accueil</h5>
            <!-- Recensement avec status active -->
            <select class="form-control form-control-sm shadow-sm" style="width:180px" name="recensement" id="recensement" onChange="ActialiserAffichage()">
                <?php
                    $database = new Database();
                    $db = $database->getConnection();
                    $recensement = new Recensement($db);
                    $stmt = $recensement->readAllActive();
                    $num = $stmt->rowCount();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        echo "<option value={$id}>{$nom_recensement}</option>";
                }
                ?>
            </select>
        </div>
    </div>
</div>
<!-- Content Row -->
<div class="row" id="gridTotal">
    <!-- Contenu ecrit par statistique en utilisant ajax  getTotalRencensement()-->
</div>


<?php include "footer.php" ?>
<script>
    $("#accueilItem").addClass("active");
    ActialiserAffichage();

    function ActialiserAffichage() {
        getTotalRencensement();
    }

    function getTotalRencensement(){
        var recensement = $("#recensement").val();
        var districtID = $("#districtSelect").val();
        var communeID = $("#communeSelect").val();
        $.ajax({
            type: 'POST',
            url: '../Controller/statistiqueController.php', // Le script PHP qui récupère les fokontany
            data: {
                getTotalRecensement: 1,
                recensement_id: recensement
            },
            success: function(html) {
                $('#gridTotal').html(html);
            }
        });
    }

</script>