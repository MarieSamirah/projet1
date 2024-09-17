<?php include "header.php" ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-sm-flex align-items-center justify-content-between">
            <div>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalAdd"><i class="fas fa-plus fa-sm text-white-60"></i> Ajouter commune</a>
            </div>
            <div class="d-sm-flex">
                <select class="form-control form-control-sm shadow mx-4" style="width: 160px;" name="region" id="regionSelect" required>
                    <option value="">Choisir region</option>
                    <?php
                    $database = new Database();
                    $db = $database->getConnection();
                    $region = new Region($db);
                    $stmt = $region->read();
                    $num = $stmt->rowCount();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        echo "<option value={$id}>{$nom}</option>";
                    }
                    ?>
                </select>
                <select class="form-control form-control-sm shadow" style="width: 160px;" name="district" id="districtSelect" required>
                    <option value="">Aucun District</option>
                </select>
                
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive" id="listeCommune">
            <table class="table table-bordered table-smM" id="dataTable" width="100%" cellspacing="0">
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
                    $database = new Database();
                    $db = $database->getConnection();
                    $commune = new Commune($db);
                    $stmt = $commune->readJoin();
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
        </div>
    </div>
</div>

<!-- Add Modal-->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="ModalAjout"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="ModalAjout">Ajout de commune</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="../Controller/communeController.php" method="POST">
                <br>
                <div class="form-group py-3 px-3">
                    <select class="form-control" name="region" id="region">
                        <option value="">Choisir region</option>
                        <?php
                        $region = new Region($db);
                        $stmt = $region->read();
                        $num = $stmt->rowCount();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);
                            echo "<option value={$id}>{$nom}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group py-3 px-3">
                    <select class="form-control" name="district" id="district">
                        <option value="">Pas de districts disponibles</option>
                    </select>
                </div>
                <div class="form-group py-3 px-3">
                    <input type="text" class="form-control form-control-user" name="nom"
                        id="nom_commune" placeholder="Nom commune">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="reset" data-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary" type="submit" name="ajouter">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Modal-->
<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="ModalAjout"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="ModalAjout">Modification de commune</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="../Controller/communeController.php" method="POST">
                <br>
                <div class="form-group py-3 px-3">
                    <select class="form-control" name="region" id="region_edit">
                        <option value="">Choisir region</option>
                        <?php
                        $region = new Region($db);
                        $stmt = $region->read();
                        $num = $stmt->rowCount();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);
                            echo "<option value={$id}>{$nom}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group py-3 px-3">
                    <select class="form-control" name="district" id="district_edit">
                        <option value="">Pas de districts disponibles</option>
                    </select>
                </div>
                <div class="form-group py-3 px-3">
                    <input type="text" class="form-control form-control-user" name="nom"
                        id="nom_commune_edit" placeholder="Nom commune">
                </div>
                <div class="form-group py-3 px-3 d-none">
                    <input type="text" class="form-control form-control-user" name="id"
                        id="id" placeholder="Id" type="number" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="reset" data-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary" type="submit" name="modifier">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Update DELETE-->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="ModalSupprimer"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="ModalSupprimer">Suppression commune</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="../Controller/communeController.php" method="post">
                <br>
                <div class="form-group py-3 text-center">
                    <i><h6>Voulez-vous vraiment supprimer la commune <span id="nom_com_del"></span>?</h6></i>
                </div>
                <div class="form-group py-3 px-3 d-nonek">
                    <input type="text" class="form-control form-control-user" name="id"
                        id="id_delete" placeholder="Id" type="number" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="reset" data-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary" type="submit" name="supprimer">Confirmer</button>
                </div>
            </form>

        </div>
    </div>
</div>

<?php include "footer.php" ?>
<script>
    function prepareUpdate(id_commune, id_region, id_district, nom_commune) {
        // Afficher le modal de modification
        $("#modalUpdate").modal("show");
        // Ajouter la valeur dans chaque champs
        $("#region_edit").val(id_region);
        getDistrictRegion(id_region, 'district_edit', id_district);
        $("#id").val(id_commune);
        $("#nom_commune_edit").val(nom_commune);
        
    }

    function prepareDelete(identifiant, nomCom) {
        // Afficher le modal de modification
        $("#modalDelete").modal("show");
        // Ajouter la valeur dans chaque champs
        $("#id_delete").val(identifiant);
        $("#nom_com_del").text(nomCom);
    }

    function getDistrictRegion(regionID, id_select, id_dst) {
        if (regionID) {
            $.ajax({
                type: 'POST',
                url: '../Controller/affichageFormController.php', // Le script PHP qui récupère les districts
                data: {
                    region_id: regionID
                },
                success: function(html) {
                    $('#' + id_select).html(html);
                    if(id_dst != 0) {
                        $("#district_edit").val(id_dst);
                    }
                }
            });
        } else {
            $('#' + id_select).html('<option value="">Choisir district</option>');
        }
    }

    function getListeCommune()
    {
        var regionID = $("#regionSelect").val();
        var districtID = $("#districtSelect").val();
        $.ajax({
            type: 'POST',
            url: '../Controller/communeController.php', // Le script PHP qui récupère les fokontany
            data: {
                getListe: 1,
                region_id: regionID,
                district_id: districtID
            },
            success: function(html) {
                $('#listeCommune').html(html);
                updateDataTable("#dataTableNouveau");
            }
        });
    }

    $(document).ready(function() {
        $("#departementItem").addClass("active");
        $("#communeItem").addClass("active");
        $("#currentTitle").html("Commune");

        $('#region').change(function() {
            var regionID = $(this).val();
            getDistrictRegion(regionID, 'district', 0);
        });

        $('#region_edit').change(function() {
            var regionID = $(this).val();
            getDistrictRegion(regionID, 'district_edit', 0);
        });

        $('#regionSelect').change(function() {
            var regionID = $(this).val();
            getDistrictRegion(regionID, "districtSelect", 0);
            getListeCommune();
        });

        $('#districtSelect').change(function() {
            getListeCommune();
        });
    });
</script>