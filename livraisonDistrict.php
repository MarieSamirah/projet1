<?php include "header.php" ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-sm-flex align-items-center justify-content-between">
            <div>
                <h5 class="m-0 font-weight-bold text-primary">LivraisonDistrict</h5>
            </div>
            <div>
                <span class="m-0 font-weight-bold text-primary">LivraisonDistrict</span>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"data-toggle="modal" data-target="#modalAdd"><i class="fas fa-plus fa-sm text-white-60"></i>Nouvelle inscription</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-smM" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>District</th>
                        <th>Recensement</th>
                        <th>Nom du remettant</th>
                        <th>Nom receptionaire</th>
                        <th class="text-center">Date livraison</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $database = new Database();
                    $db = $database->getConnection();
                    $livraisondistrict= new LivraisonDistrict($db);
                    $stmt = $livraisondistrict->readJoin();
                    $num = $stmt->rowCount();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        echo "<tr>";
                        echo "<td>{$district_nom}</td>";
                        echo "<td>{$recensement_nom}</td>";
                        echo "<td>{$nom_remettant}</td>";
                        echo "<td>{$nom_receptionaire}</td>";
                        echo "<td class='text-center'>{$date_livraison}</td>";
                        echo "<td class='text-center'>";
                        echo "<a href='edit.php?id={$id}'><i class='fas fa-edit text-warning'></i></a> ";
                        echo "<a href='delete.php?id={$id}'><i class='fas fa-trash text-danger'></i> </a>";
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
                <h5 class="modal-title text-center" id="ModalAjout">Livraison District</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="../Controller/livraisonDistrictController.php" method="POST">
                <br>
                <div class="form-group py-2 px-3">
                    <select class="form-control" name="region" id="livraison" required>
                        <option value="">LivraisonDistrict</option>
                        <?php
                        $district = new District($db);
                        $stmt = $district->read();
                        $num = $stmt->rowCount();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);
                            echo "<option value={$id}>{$nom}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group py-2 px-3">
                    <input type="text" class="form-control form-control-user" name="recensement"
                        id="nom2" placeholder="Recensement" required>
                </div>
                <div class="form-group py-2 px-3">
                    <input type="text" class="form-control form-control-user" name="remettant"
                        id="nom3" placeholder="Nom du remettant" required>
                </div>
                <div class="form-group py-2 px-3">
                    <input type="text" class="form-control form-control-user" name="receptionnaire"
                        id="nom4" placeholder="Nom receptionnaire" required>
                </div>
                <div class="form-group py-2 px-3">
                    <input type="text" class="form-control form-control-user" name="date"
                        id="nom5" placeholder="Date de livraison" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="reset" data-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary" type="submit" name="ajouter">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include "footer.php" ?>
<script>
    $("#carnetItem").addClass("active");
    $("#dstItem").addClass("active");
</script>