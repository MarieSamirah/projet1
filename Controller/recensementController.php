<link href="../View/css/sb-admin-2.min.css" rel="stylesheet">
<script src="../View/Vendor/jquery/jquery.min.js"></script>
<script src="../view/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../View/js/notify.min.js"></script>
<?php
include "../Model/Database.php";
include "../Model/recensement.php";

if(isset($_POST['ajouter']))
{
    $database = new Database();
    $db = $database->getConnection();

    $recensement = new Recensement($db);
    $recensement->nom_recensement = $_POST['recensement'];
    $recensement->observation = $_POST['observation'];
    $recensement->status = $_POST['status'];

    if ($recensement->create()) {
        header("Location: ../View/recensement.php");
        exit();
    }
}

if(isset($_POST['modifier']))
{
    $database = new Database();
    $db = $database->getConnection();

    $recensement = new Recensement($db);
    $recensement->id = $_POST['id'];
    $recensement->nom_recensement = $_POST['recensement'];
    $recensement->observation = $_POST['observation'];
    $recensement->status = $_POST['status'];

    if ($recensement->update()) {
        header("Location: ../View/recensement.php");
        exit();
    }
}
if(isset($_POST['supprimer']))
{
    $database = new Database();
    $db = $database->getConnection();

    $recensement = new Recensement($db);
    $recensement->id = $_POST['id'];
   

    if ($recensement->delete()) {
        header("Location: ../View/recensement.php");
        exit();
    }
}
?>