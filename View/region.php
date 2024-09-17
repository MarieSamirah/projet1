<?php include "header.php" ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-sm-flex align-items-center justify-content-between">
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalAdd"><i class="fas fa-plus fa-sm text-white-60"></i> Ajouter Region</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive" id="listeDistrict">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Région</th>
                        <th class='text-center'>Nb District</th>
                        <th class='text-center'>Nb Commune</th>
                        <th class='text-center'>Nb Fokontany</th>
                        <th class='text-center'>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $database = new Database();
                    $db = $database->getConnection();
                    $region = new Region($db);
                    $stmt = $region->readJoin();
                    $num = $stmt->rowCount();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        echo "<tr>";
                            echo "<td>{$region_nom}</td>";
                            echo "<td class='text-center'>{$compte_district}</td>";
                            echo "<td class='text-center'>{$compte_commune}</td>";
                            echo "<td class='text-center'>{$compte_fokontany}</td>";
                            echo "<td class='text-center'>";
                            echo "<a href=\"javascript:prepareUpdate({$region_id}, `{$region_nom}`)\"><i class='fas fa-edit text-warning'></i></a> ";
                            echo "<a href=\"javascript:prepareDelete({$region_id}, `{$region_nom}`)\"><i class='fas fa-trash text-danger'></i> </a>";
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
                <h5 class="modal-title text-center" id="ModalAjout">Ajout de Region</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="../Controller/regionController.php" method="post">
                <br>
                <div class="form-group py-3 px-3">
                    <input type="text" class="form-control form-control-user" name="nom"
                        id="nom" placeholder="Nom region" required>
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
<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="ModalModif"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="ModalModif">Modification de Region</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="../Controller/regionController.php" method="post">
                <br>
                <div class="form-group py-3 px-3">
                    <input type="text" class="form-control form-control-user" name="nom"
                        id="nom_edit" placeholder="Nom district" required>
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
                <h5 class="modal-title text-center" id="ModalSupprimer">Suppression de Region</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="../Controller/regionController.php" method="post">
                <br>
                <div class="form-group py-3 text-center">
                    <i><h6>Voulez-vous vraiment supprimer <span id="nom_reg_del"></span>?</h6></i>
                </div>
                <div class="form-group py-3 px-3 d-none">
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
    $("#departementItem").addClass("active");
    $("#regionItem").addClass("active");
    $("#currentTitle").html("Region");

    function prepareUpdate(identifiant, nomRegion)
    {
        // Afficher le modal de modification
        $("#modalUpdate").modal("show");
        // Ajouter la valeur dans chaque champs
        $("#id").val(identifiant);
        $("#nom_edit").val(nomRegion);
    }

    function prepareDelete(identifiant, nomRegion)
    {
        // Afficher le modal de modification
        $("#modalDelete").modal("show");
        // Ajouter la valeur dans chaque champs
        $("#id_delete").val(identifiant);
        $("#nom_reg_del").text(nomRegion);
    }
</script>