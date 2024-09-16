<?php include "header.php" ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-sm-flex align-items-center justify-content-between">
            <div>
                <h5 class="m-0 font-weight-bold text-primary">Recensement</h5>
            </div>
            <div>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"data-toggle="modal" data-target="#modalAdd"><i class="fas fa-plus fa-sm text-white-60"></i> Ajouter recensement</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-smM" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Recensement</th>
                        <th>Observation</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $database = new Database();
                    $db = $database->getConnection();
                    $recensement = new Recensement($db);
                    $stmt = $recensement->read();
                    $num = $stmt->rowCount();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        echo "<tr>";
                        echo "<td>{$nom_recensement}</td>";
                        echo "<td>{$observation}</td>";
                        echo "<td class=`{$status}`>{$status}</td>";
                        echo "<td class='text-center'>";
                        echo "<a href='javascript:prepareUpdate({$id}, `{$nom_recensement}`,  `{$observation}`, `{$status}`)'><i class='fas fa-edit text-warning'></i></a> ";
                        echo "<a href='javascript:prepareDelete({$id}, `{$nom_recensement}`)'><i class='fas fa-trash text-danger'></i></a>";
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
                <h5 class="modal-title text-center" id="ModalAjout">Ajout recensement</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="../Controller/recensementController.php" method="post">
                <br>
                <div class="form-group py-3 px-3">
                    <input type="text" class="form-control" name="recensement" id="recensement" placeholder="Recensement" required>
                </div>
                <div class="form-group py-3 px-3">
                    <input type="text" class="form-control" name="observation"
                        id="observation" placeholder="observation" required>
                </div>
                <div class="form-group py-3 px-3">
                    <select class="form-control" name="status" id="status" required>
                        <option value="Active">Active</option>
                    </select>
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
                <h5 class="modal-title text-center" id="ModalModif">Modification recensement</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="../Controller/recensementController.php" method="post">
                <br>
                <div class="form-group py-3 px-3">
                    <input type="text" class="form-control" name="recensement" id="recensement_edite" placeholder="Recensement" required>
                </div>
                <div class="form-group py-3 px-3">
                    <input type="text" class="form-control form-control-user" name="observation"
                        id="observation_edite" placeholder="observation" required>
                </div>
                <div class="form-group py-3 px-3">
                    <select class="form-control" name="status" id="status_edite" required>
                        <option value="Active">Active</option>
                        <option value="Fermée">Fermée</option>
                    </select>
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

<!-- Update delete-->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="ModalSupprimer"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="ModalSupprimer">Suppression du district</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="../Controller/recensementController.php" method="post">
                <br>
                <div class="form-group py-3 text-center">
                    <i><h6>Voulez-vous vraiment supprimer <span id="nom_rcs"></span>?</h6></i>
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
    $("#recensementItem").addClass("active");
    function prepareUpdate(identifiant, nomRcs, observation, status)
    {
        // Afficher le modal de modification
        $("#modalUpdate").modal("show");
        // Ajouter la valeur dans chaque champs
        $("#id").val(identifiant);
        $("#recensement_edite").val(nomRcs);
        $("#observation_edite").val(observation);
        $("#status_edite").val(status);
    }

    function prepareDelete(identifiant, rcs)
    {
        // Afficher le modal de modification
        $("#modalDelete").modal("show");
        // Ajouter la valeur dans chaque champs
        $("#id_delete").val(identifiant);
        $("#nom_rcs").text(rcs);
    }

</script>
