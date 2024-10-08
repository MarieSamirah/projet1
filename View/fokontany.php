<?php include "header.php" ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-sm-flex align-items-center justify-content-between">
            <div>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalAdd"><i class="fas fa-plus fa-sm text-white-60"></i> Ajouter Fokontany</a>
            </div>
            <div class="d-sm-flex">
                <select class="form-control form-control-sm shadow" style="width: 160px;" name="region" id="regionSelect" required>
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
                <select class="form-control form-control-sm shadow  mx-4" style="width: 160px;" name="district" id="districtSelect" required>
                    <option value="">Aucun District</option>
                </select>
                <select class="form-control form-control-sm shadow" style="width: 160px;" name="commune" id="communeSelect" required>
                    <option value="">Aucune Commune</option>
                </select>
                
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive" id="listeFokontany">
            <table class="table table-bordered table-smM" id="dataTable" width="100%" cellspacing="0">
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
                    $database = new Database();
                    $db = $database->getConnection();
                    $fokontany = new Fokontany($db);
                    $stmt = $fokontany->readJoin();
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
        </div>
    </div>
</div>

<!-- Add Modal-->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="ModalAjout"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="ModalAjout">Ajout de fokontany</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="../Controller/fokontanyController.php" method="POST">
                <br>
                <div class="form-group py-2 px-3">
                    <select class="form-control" name="region" id="region" required>
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
                <div class="form-group py-2 px-3">
                    <select class="form-control" name="district" id="district" required>
                        <option value="">Pas de districts disponibles</option>
                    </select>
                </div>
                <div class="form-group py-2 px-3">
                    <select class="form-control" name="commune" id="commune" required>
                        <option value="">Pas de commune disponible</option>
                    </select>
                </div>
                <div class="form-group py-2 px-3">
                    <input type="text" class="form-control form-control-user" name="nom"
                        id="nom" placeholder="Nom fokontany" required>
                </div>
                <div class="form-group py-2 px-3">
                    <input type="text" class="form-control form-control-user" name="nom_chef"
                        id="nom_chef" placeholder="Nom du chef Fokontany" required>
                </div>
                <div class="form-group py-2 px-3">
                    <input type="text" class="form-control form-control-user" name="contact"
                        id="contact" placeholder="Contact du Fokontany" required>
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
                <h5 class="modal-title text-center" id="ModalAjout">Ajout de fokontany</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="../Controller/fokontanyController.php" method="POST">
                <br>
                <div class="form-group py-3 px-3">
                    <input type="text" class="form-control form-control-user" name="nom"
                        id="nom_edit" placeholder="Nom fokontany" required>
                </div>
                <div class="form-group py-3 px-3">
                    <input type="text" class="form-control form-control-user" name="nom_chef"
                        id="nom_chef_edit" placeholder="Nom du chef Fokontany" required>
                </div>
                <div class="form-group py-3 px-3">
                    <input type="text" class="form-control form-control-user" name="contact"
                        id="contact_edit" placeholder="Contact du Fokontany" required>
                </div>
                <div class="form-group py-3 px-3 d-none">
                    <input type="text" class="form-control form-control-user" name="id"
                        id="id_edit" placeholder="Contact du Fokontany" required>
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
            <form action="../Controller/fokontanyController.php" method="post">
                <br>
                <div class="form-group py-3 text-center">
                    <i>
                        <h6>Voulez-vous vraiment supprimer du Fokontany <span id="nom_fkt_del"></span>?</h6>
                    </i>
                </div>
                <div class="form-group py-3 px-3 d-none">
                    <input type="text" class="form-control form-control-user" name="id"
                        id="id_fkt_delete" placeholder="Id" type="number" required>
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
    function prepareUpdate(id, nom, nom_chef, contact) {
        // Afficher le modal de modification
        $("#modalUpdate").modal("show");
        // Ajouter la valeur dans chaque champs
        $("#id_edit").val(id);
        $("#nom_edit").val(nom);
        $("#nom_chef_edit").val(nom_chef);
        $("#contact_edit").val(contact);

    }

    function prepareDelete(identifiant, nomCom) {
        // Afficher le modal de modification
        $("#modalDelete").modal("show");
        // Ajouter la valeur dans chaque champs
        $("#id_fkt_delete").val(identifiant);
        $("#nom_fkt_del").text(nomCom);
    }

    function getDistrictRegion(regionID, id_select) {
        if (regionID) {
            $.ajax({
                type: 'POST',
                url: '../Controller/affichageFormController.php', // Le script PHP qui récupère les districts
                data: {
                    region_id: regionID
                },
                success: function(html) {
                    $('#' + id_select).html(html);
                }
            });
        } else {
            $('#' + id_select).html('<option value="">Choisir district</option>');
        }
    }

    function getCommuneDistrict(districtID, id_select) {
        if (districtID) {
            $.ajax({
                type: 'POST',
                url: '../Controller/affichageFormController.php', // Le script PHP qui récupère les districts
                data: {
                    district_id: districtID
                },
                success: function(html) {
                    $('#' + id_select).html(html);
                }
            });
        } else {
            $('#' + id_select).html('<option value="">Choisir commune</option>');
        }
    }

    function getListeFokontany()
    {
        var regionID = $("#regionSelect").val();
        var districtID = $("#districtSelect").val();
        var communeID = $("#communeSelect").val();
        $.ajax({
            type: 'POST',
            url: '../Controller/fokontanyController.php', // Le script PHP qui récupère les fokontany
            data: {
                getListe: 1,
                region_id: regionID,
                district_id: districtID,
                commune_id: communeID
            },
            success: function(html) {
                $('#listeFokontany').html(html);
                updateDataTable("#dataTableNouveau");
            }
        });
    }

    $(document).ready(function() {
        $("#departementItem").addClass("active");
        $("#fokontanyItem").addClass("active");
        $("#currentTitle").html("Fokontany");

        $('#region').change(function() {
            var regionID = $(this).val();
            getDistrictRegion(regionID, 'district', 0);
        });

        $('#district').change(function() {
            var districtID = $(this).val();
            getCommuneDistrict(districtID, 'commune', 0);
        });

        $('#region_edit').change(function() {
            var regionID = $(this).val();
            getDistrictRegion(regionID, 'district_edit', 0);
        });

        $('#regionSelect').change(function() {
            var regionID = $(this).val();
            $('#districtSelect').val("");
            $('#communeSelect').val("");
            getDistrictRegion(regionID, "districtSelect");
            $('#communeSelect').html('<option value="">Choisir commune</option>');
            getListeFokontany(); //Afficher le tableau contenant la liste
        });

        $('#districtSelect').change(function() {
            var districtID = $(this).val();
            $('#communeSelect').val("");
            getCommuneDistrict(districtID, "communeSelect");
            getListeFokontany(); //Afficher le tableau contenant la liste
        });

        $('#communeSelect').change(function() {
            var communeID = $(this).val();
            //getFokontanyCommune(communeID);
            getListeFokontany(); //Afficher le tableau contenant la liste
        });
    });
</script>