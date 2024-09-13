controlleur
<?php
include "../Model/Database.php";
include "../Model/LivraisonFokontany.php";

if(isset($_POST['ajouter']))
{
    $database = new Database();
    $db = $database->getConnection();

    $livraisonfokontany = new LivraisonFokontany($db);
    $livraisonfokontany->nombre_recensement = $_POST['nombre_recensement'];
    $livraisonfokontany->nombre_recu = $_POST['nombre_recu'];
    $livraisonfokontany->nombre_doublon = $_POST['nombre_doublon'];
    $livraisonfokontany->nombre_distribue = $_POST['nombre_distribue'];
    $livraisonfokontany->nombre_reste_distribue = $_POST['nombre_reste_distribue'];
    $livraisonfokontany->nombre_autre_anomalie = $_POST['nombre_autre_anomalie'];
    $livraisonfokontany->date_livraison= $_POST['date_livraison'];
    $livraisonfokontany->fokontanyID= $_POST['fokontanyID'];
    $livraisonfokontany->observation= $_POST['observation'];

    
    if ($livraisonfokontany->create()) {
        header("Location: ../View/livraisonFokontany.php");
        exit();
    }
}
if(isset($_POST['modifier']))
{
    $database = new Database();
    $db = $database->getConnection();

    $livraisonfokontany = new LivraisonFokontany($db);
    $livraisonfokontany->nombre_recensement = $_POST['nombre_recensement'];
    $livraisonfokontany->nombre_recu = $_POST['nombre_recu'];
    $livraisonfokontany->nombre_doublon = $_POST['nombre_doublon'];
    $livraisonfokontany->nombre_distribue = $_POST['nombre_distribue'];
    $livraisonfokontany->nombre_reste_distribue = $_POST['nombre_reste_distribue'];
    $livraisonfokontany->nombre_autre_anomalie = $_POST['nombre_autre_anomalie'];
    $livraisonfokontany->date_livraison= $_POST['date_livraison'];
    $livraisonfokontany->fokontanyID= $_POST['fokontanyID'];
    $livraisonfokontany->observation= $_POST['observation'];
    
    if ($livraisonfokontany->create()) {
        header("Location: ../View/livraisonFokontany.php");
        exit();
    }
}

if(isset($_POST['supprimer']))
{
    $database = new Database();
    $db = $database->getConnection();

    $livraisonfokontany= new LivraisonFokontany($db);
    $livraisonfokontany->id = $_POST['id'];

    if ($livraisonfokontany->delete()) {
        header("Location: ../View/livraisonFokontany.php");
        exit();
    }
    
}

?>