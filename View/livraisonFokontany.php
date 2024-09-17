<?php include "header.php" ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-sm-flex align-items-center justify-content-between">
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"data-toggle="modal" data-target="#modalAdd"><i class="fas fa-plus fa-sm text-white-60"></i> Nouvelle Livraison</a>
            <div class="d-sm-flex">
            <select class="form-control form-control-sm shadow mx-4" style="width:160px" name="recensement" id="recensementSelect">
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
                <select class="form-control form-control-sm shadow " style="width: 160px;" name="region" id="regionSelect" required>
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
                <select class="form-control form-control-sm shadow mx-4" style="width: 160px;" name="district" id="districtSelect" required>
                    <option value="">Aucun District</option>
                </select>
                <select class="form-control form-control-sm shadow" style="width: 160px;" name="commune" id="communeSelect" required>
                    <option value="">Aucune Commune</option>
                </select>
                
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive" id="listeLivraisonFkt">
            <!-- Le contenu ici est faite par ajax, il est dans livraisonFokontanyController -->
        </div>
    </div>
</div>
          
<!-- Add Modal-->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="ModalAjout" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalAjout">Ajout de livraison fokontany</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../Controller/livraisonFokontanyController.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                       <div class="py-2 px-3">
                            <!-- Recensement avec status active -->
                            <div class="form-group">
                                <label for="recensementAdd">Recensement:</label>
                                <select class="form-control" name="recensementID" id="recensementAdd" required>
                                    <option value="">Choisir recensement</option>
                                    <?php
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
                            <div class="form-group">
                                <label for="regionAdd">Region:</label>
                                <select class="form-control" name="region" id="regionAdd" required onChange="getDistrictRegion(this.value, '#districtAdd')">
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
                            <div class="form-group">
                                <label for="districtAdd">District:</label>
                                <select class="form-control" name="district" id="districtAdd" required onChange="getCommuneDistrict(this.value, '#communeAdd')">
                                    <option value="">Pas de districts disponibles</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="communeAdd">Commune:</label>
                                <select class="form-control" name="commune" id="communeAdd" required onChange="getFokontanyCommune(this.value, '#fokontanyAdd')">
                                    <option value="">Pas de commune disponible</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fokontanyAdd">Fokontany:</label>
                                <select class="form-control" name="fokontanyID" id="fokontanyAdd" required>
                                    <option value="">Pas de commune disponible</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date_livraison">Date Livraison:</label>
                                <input type="date" class="form-control" name="date_livraison" id="date_livraison" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre_recensement">Nombre Recensement:</label>
                                <input type="number" class="form-control" name="nombre_recensement" id="nombre_recensement" required>
                            </div>
                       </div>
                    </div>
                    <div class="col-md-6">
                        <div class="py-2 px-3">
                            <div class="form-group">
                                <label for="nombre_recu">Nombre Reçu:</label>
                                <input type="number" class="form-control" name="nombre_recu" id="nombre_recu" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre_doublon">Nombre Doublon:</label>
                                <input type="number" class="form-control" name="nombre_doublon" id="nombre_doublon" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre_distribue">Nombre Distribué:</label>
                                <input type="number" class="form-control" name="nombre_distribue" id="nombre_distribue" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre_reste_distribue">Nombre Reste Distribué:</label>
                                <input type="number" class="form-control" name="nombre_reste_distribue" id="nombre_reste_distribue" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre_autre_anomalie">Nombre Autre Anomalie:</label>
                                <input type="number" class="form-control" name="nombre_autre_anomalie" id="nombre_autre_anomalie" required>
                            </div>
                            <div class="form-group">
                                <label for="observation">Observation :</label>
                                <textarea class="form-control" name="observation" id="observation_id" rows="4" placeholder="Entrez vos observations ici..." required></textarea>
                            </div>
                        </div>
                    </div>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="ModalAjout">Ajout distribution</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="../Controller/livraisonFokontanyController.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="py-3 px-3">
                            <div class="form-group">
                                <label for="nombre_recensement">Nombre Recensement:</label>
                                <input type="number" class="form-control" name="nombre_recensement" id="recensement" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre_recu">Nombre Reçu:</label>
                                <input type="number" class="form-control" name="nombre_recu" id="recu" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre_doublon">Nombre Doublon:</label>
                                <input type="number" class="form-control" name="nombre_doublon" id="doublon" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre_distribue">Nombre Distribué:</label>
                                <input type="number" class="form-control" name="nombre_distribue" id="distribue" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="py-3 px-3">
                            <div class="form-group">
                                <label for="nombre_reste_distribue">Nombre Reste Distribué:</label>
                                <input type="number" class="form-control" name="nombre_reste_distribue" id="reste_distribue" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre_autre_anomalie">Nombre Autre Anomalie:</label>
                                <input type="number" class="form-control" name="nombre_autre_anomalie" id="autre_anomalie" required>
                            </div>
                            <div class="form-group">
                                <label for="date_livraison">Date Livraison:</label>
                                <input type="date" class="form-control" name="date_livraison" id="date" required>
                            </div>
                            <div class="form-group">
                                <label for="observation">Observation :</label>
                                <textarea class="form-control" name="observation" id="observation" rows="4" placeholder="Entrez vos observations ici..." required></textarea>
                            </div>
                            <div class="form-group d-none">
                                <input type="number" class="form-control" name="fokontanyID" id="fokontany" required>
                            </div>
                            <div class="form-group d-none">
                                <input type="number" class="form-control" name="id" id="id" required>
                            </div>
                        </div>
                    </div>
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
                <h5 class="modal-title text-center" id="ModalSupprimer">Suppression distribution/h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="../Controller/livraisonFokontanyController.php" method="post">
                <br>
                <div class="form-group py-3 text-center">
                    <i>
                        <h6>Voulez-vous vraiment supprimer du distrubtion <span id="nom_fkt_del"></span>?</h6>
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
    $("#carnetItem").addClass("active");
    $("#fktItem").addClass("active");
    $("#currentTitle").html("Livraison Fokontany");
    getListeLivraison(); //Afficher le tableau contenant la liste

    function prepareUpdate(id, nombre_recesement, nombre_recu, nombre_doublon, nombre_distribue, nombre_reste_ditribue, nombre_autre_anomalie, date_livraison, fokontanyID,observation) {
        // Afficher le modal de modification
        $("#modalUpdate").modal("show");
        // Ajouter la valeur dans chaque champs
        $("#id").val(id);
        $("#recensement").val(nombre_recesement);
        $("#recu").val(nombre_recu);
        $("#doublon").val(nombre_doublon);
        $("#distribue").val(nombre_distribue);
        $("#reste_distribue").val(nombre_reste_ditribue);
        $("#autre_anomalie").val(nombre_autre_anomalie);
        $("#date").val(date_livraison);
        $("#fokontany").val(fokontanyID);
        $("#observation").val(observation);

    
    }
    function prepareDelete(identifiant, nomCom) {
        // Afficher le modal de modification
        $("#modalDelete").modal("show");
        // Ajouter la valeur dans chaque champs
        $("#id_fkt_delete").val(identifiant);
        $("#nom_fkt_del").text(nomCom);
    }

    /* Ajax sur le select de recherche */

    $('#recensementSelect').change(function() {
        getListeLivraison(); //Afficher le tableau contenant la liste
    });

    $('#regionSelect').change(function() {
        var regionID = $(this).val();
        getDistrictRegion(regionID, "#districtSelect");
        $('#communeSelect').html('<option value="">Choisir commune</option>');
        getListeLivraison(); //Afficher le tableau contenant la liste
    });

    $('#districtSelect').change(function() {
        var districtID = $(this).val();
        getCommuneDistrict(districtID, "#communeSelect");
        getListeLivraison(); //Afficher le tableau contenant la liste
    });

    $('#communeSelect').change(function() {
        var communeID = $(this).val();
        //getFokontanyCommune(communeID);
        getListeLivraison(); //Afficher le tableau contenant la liste
    });

    function getDistrictRegion(regionID, selectId) {
        if (regionID) {
            $.ajax({
                type: 'POST',
                url: '../Controller/affichageFormController.php', // Le script PHP qui récupère les districts
                data: {
                    region_id: regionID
                },
                success: function(html) {
                    $(selectId).html(html);
                }
            });
        } else {
            $(selectId).html('<option value="">Choisir district</option>');
        }
    }

    function getCommuneDistrict(districtID, selectId) {
        if (districtID) {
            $.ajax({
                type: 'POST',
                url: '../Controller/affichageFormController.php', // Le script PHP qui récupère les districts
                data: {
                    district_id: districtID
                },
                success: function(html) {
                    $(selectId).html(html);
                }
            });
        } else {
            $(selectId).html('<option value="">Choisir commune</option>');
        }
    }

    function getFokontanyCommune(communeID, selectId) {
        if (communeID) {
            $.ajax({
                type: 'POST',
                url: '../Controller/affichageFormController.php', // Le script PHP qui récupère les fokontany
                data: {
                    commune_id: communeID
                },
                success: function(html) {
                    $(selectId).html(html);
                }
            });
        } else {
            $(selectId).html('<option value="">Choisir Fokontany</option>');
        }
    }

    function getListeLivraison()
    {
        var recensementID = $("#recensementSelect").val();
        var regionID = $("#regionSelect").val();
        var districtID = $("#districtSelect").val();
        var communeID = $("#communeSelect").val();
        $.ajax({
            type: 'POST',
            url: '../Controller/livraisonFokontanyController.php', // Le script PHP qui récupère les fokontany
            data: {
                getListe: 1,
                recensement_id: recensementID,
                region_id: regionID,
                district_id: districtID,
                commune_id: communeID
            },
            success: function(html) {
                $('#listeLivraisonFkt').html(html);
                updateDataTable("#dataTableNouveau");
            }
        });
    }

    

</script>


