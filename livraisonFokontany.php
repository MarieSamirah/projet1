<?php include "header.php" ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
    <div class="d-sm-flex align-items-center justify-content-between">
            <div>
                <h5 class="m-0 font-weight-bold text-primary">LivraisonDistrict</h5>
            </div>
            <div>
                <span class="m-0 font-weight-bold text-primary">Livraison</span>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"data-toggle="modal" data-target="#modalAdd"><i class="fas fa-plus fa-sm text-white-60"></i>Fokontany</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>fokontany</th>
                        <th>Nombre recensement</th>
                        <th>Nombre carnet recu</th>
                        <th>Nombre doublon</th>
                        <th>Nombre Anomalie</th>
                        <th>Nombre distribue</th>
                        <th>Nombre reste distribue</th>
                        <th>Date livraison</th>
                        <th>Observation</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $database = new Database();
                    $db = $database->getConnection();
                    $livraisonfokontany = new LivraisonFokontany($db);
                    $stmt = $livraisonfokontany->read();
                    $num = $stmt->rowCount();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        $fokontanyName = $livraisonfokontany->getFokontanyName($fokontanyID);
                        echo "<tr>";
                        echo "<td>{$fokontanyName}</td>";
                        echo "<td>{$nombre_recensement}</td>";
                        echo "<td>{$nombre_recu}</td>";
                        echo "<td>{$nombre_doublon}</td>";
                        echo "<td>{$nombre_autre_anomalie}</td>"; 
                        echo "<td>{$nombre_distribue}</td>"; 
                        echo "<td>{$nombre_reste_distribue}</td>";
                        echo "<td>{$date_livraison}</td>";
                        echo "<td>{$observation}</td>";
                        echo "<td>";
                        echo "<a href='javascript:prepareUpdate({$id}, `{$nombre_recensement}`, `{$nombre_recu}`, `{$nombre_doublon}`, `{$nombre_distribue}`, `{$nombre_reste_distribue}`, `{$nombre_autre_anomalie}`, `{$date_livraison}`, `{$fokontanyID}`, `{$observation}`)'><i class='fas fa-edit text-warning'></i></a> ";
                        echo "<a href='javascript:prepareDelete({$id}, `{$fokontanyName}`)'><i class='fas fa-trash text-danger'></i></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
                <?php
                // Instancier la classe LivraisonFokontany
                $livraisonfonkotany = new LivraisonFokontany($db);

                // Obtenir les totaux
                $totals = $livraisonfonkotany->getTotals();
                ?>

                <tfoot>

                    <tr>
                        <td colspan="10"></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td id="totalRecensement"><?= $totals['total_recensement'] ?></td>
                        <td id="totalRecu"><?= $totals['total_recu'] ?></td>
                        <td id="totalDoublon"><?= $totals['total_doublon'] ?></td>
                        <td id="totalAnomalie"><?= $totals['total_anomalie'] ?></td>
                        <td id="totalDistribue"><?= $totals['total_distribue'] ?></td>
                        <td id="totalResteDistribue"><?= $totals['total_reste_distribue'] ?></td>
                        <td></td> <!-- Empty for Date -->
                        <td></td> <!-- Empty for Observation -->
                        <td></td> <!-- Empty for Action -->
                    </tr>
                </tfoot>

        </table>
    </div>
</div>
            </table>
        </div>
    </div>
</div>
          
<!-- Add Modal-->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="ModalAjout" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalAjout">Ajout de livraison fokontany</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../Controller/livraisonFokontanyController.php" method="POST">
                    <div class="form-group">
                        <label for="nombre_recensement">Nombre Recensement:</label>
                        <input type="number" class="form-control" name="nombre_recensement" id="nombre_recensement" required>
                    </div>
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
                        <label for="date_livraison">Date Livraison:</label>
                        <input type="date" class="form-control" name="date_livraison" id="date_livraison" required>
                    </div>
                    <div class="form-group">
                        <label for="fokontanyID">ID Fokontany:</label>
                        <input type="number" class="form-control" name="fokontanyID" id="fokontanyID" required>
                    </div>
                    <div class="form-group">
                        <label for="observation">Observation :</label>
                        <textarea class="form-control" name="observation" id="observation" rows="4" placeholder="Entrez vos observations ici..." required></textarea>
                    </div>
                    <button type="submit" name="ajouter" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Update Modal-->
<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="ModalAjout"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="ModalAjout">Ajout distribution</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="../Controller/livraisonFokontanyController.php" method="POST">
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
                        <label for="fokontanyID">ID Fokontany:</label>
                        <input type="number" class="form-control" name="fokontanyID" id="fokontany" required>
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

    function prepareUpdate(id, nombre_recesement, nombre_recu, nombre_doublon, nombre_distribue, nombre_reste_ditribue, nombre_autre_anomalie, date_livraison, fokontanyID,observation) {
        // Afficher le modal de modification
        $("#modalUpdate").modal("show");
        // Ajouter la valeur dans chaque champs
        $("#id").val(id);
        $("#recesement").val(nombre_recesement);
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
    function fetchFokontany() {
    var communeID = document.getElementById('commune').value;
    if (communeID) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'fetch_fokontany.php?commune_id=' + communeID, true);
        xhr.onload = function () {
            if (this.status == 200) {
                document.getElementById('fokontanyTable').innerHTML = this.responseText;
            }
        };
        xhr.send();
    } else {
        document.getElementById('fokontanyTable').innerHTML = '';
    }
}

</script>


