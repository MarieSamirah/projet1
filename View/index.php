<?php include "header.php";?>


<div class="py-3 mb-2">
    <!-- Recensement avec status active -->
    <select class="form-control form-control-sm shadow" name="recensement" id="recensement" onChange="ActualiserAffichage()">
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

<!-- Total -->
<div class="row" id="gridTotal">
    <!-- Contenu ecrit par statistique en utilisant ajax  getTotalRencensement()-->
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-">Statistique par région</h6>
            
        </div>
    </div>
    <div class="card-body">
        <div id="statParRegion">
            <!-- Contenu ecrit par statistique en utilisant ajax -->
        </div>
    </div>
</div>


<?php include "footer.php" ?>
<script>
    $("#accueilItem").addClass("active");
    $("#currentTitle").html("Accueil");
    ActualiserAffichage();

    function ActualiserAffichage() {
        getTotalRencensement();
        getStatistiqueParRegion();
    }

    function getTotalRencensement(){
        var recensement = $("#recensement").val();
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

    function getStatistiqueParRegion(){
        var recensement = $("#recensement").val();
        $.ajax({
            type: 'POST',
            url: '../Controller/statistiqueController.php', // Le script PHP qui récupère les fokontany
            data: {
                getStatByRegion: 1,
                recensement_id: recensement
            },
            success: function(html) {
                $('#statParRegion').html(html);
                // updateDataTable("#dataTableNouveau");<
            }
        });
    }

</script>