<?php
include_once 'Database.php';

class LivraisonDistrict {
    private $conn;
    private $table_name = "livraison_district";

    public $id;
    public $districtID;
    public $recensementID;
    public $nom_remettant;
    public $nom_receptionaire;
    public $date_livraison;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Créer une nouvelle livraison pour un district
    public function create() {
        // Vérifier si le districtID existe dans la table `district`
        $checkQuery = "SELECT COUNT(*) FROM district WHERE id = :districtID";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(":districtID", $this->districtID);
        $checkStmt->execute();
        $exists = $checkStmt->fetchColumn();

        if (!$exists) {
            // Retourner false si le districtID n'existe pas
            return false;
        }

        // Si le districtID existe, procéder à l'insertion
        $query = "INSERT INTO " . $this->table_name . " 
                  SET districtID=:districtID, 
                      recensementID=:recensementID, 
                      nom_remettant=:nom_remettant, 
                      nom_receptionaire=:nom_receptionaire, 
                      date_livraison=:date_livraison";

        $stmt = $this->conn->prepare($query);

        // Protéger les données
        $this->districtID = htmlspecialchars(strip_tags($this->districtID));
        $this->recensementID = htmlspecialchars(strip_tags($this->recensementID));
        $this->nom_remettant = htmlspecialchars(strip_tags($this->nom_remettant));
        $this->nom_receptionaire = htmlspecialchars(strip_tags($this->nom_receptionaire));
        $this->date_livraison = htmlspecialchars(strip_tags($this->date_livraison));

        // Lier les paramètres
        $stmt->bindParam(":districtID", $this->districtID);
        $stmt->bindParam(":recensementID", $this->recensementID);
        $stmt->bindParam(":nom_remettant", $this->nom_remettant);
        $stmt->bindParam(":nom_receptionaire", $this->nom_receptionaire);
        $stmt->bindParam(":date_livraison", $this->date_livraison);

        // Exécuter la requête
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Lire toutes les livraisons de district
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Lire une livraison avec des jointures
    public function readJoin() {
        $query = "SELECT 
            ld.id AS id, 
            ld.nom_remettant AS nom_remettant, 
            ld.nom_receptionaire AS nom_receptionaire,
            ld.date_livraison AS date_livraison,
            d.nom AS district_nom,
            r.nom_recensement AS recensement_nom
        FROM 
            livraison_district ld
        LEFT JOIN
            district d ON ld.districtID = d.id
        LEFT JOIN
            recensement r ON ld.recensementID = r.id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Lire une livraison par ID
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->districtID = $row['districtID'];
            $this->recensementID = $row['recensementID'];
            $this->nom_remettant = $row['nom_remettant'];
            $this->nom_receptionaire = $row['nom_receptionaire'];
            $this->date_livraison = $row['date_livraison'];
        }
    }

    // Mettre à jour une livraison de district
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET districtID = :districtID, 
                      recensementID = :recensementID, 
                      nom_remettant = :nom_remettant, 
                      nom_receptionaire = :nom_receptionaire, 
                      date_livraison = :date_livraison 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Protéger les données
        $this->districtID = htmlspecialchars(strip_tags($this->districtID));
        $this->recensementID = htmlspecialchars(strip_tags($this->recensementID));
        $this->nom_remettant = htmlspecialchars(strip_tags($this->nom_remettant));
        $this->nom_receptionaire = htmlspecialchars(strip_tags($this->nom_receptionaire));
        $this->date_livraison = htmlspecialchars(strip_tags($this->date_livraison));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Lier les paramètres
        $stmt->bindParam(":districtID", $this->districtID);
        $stmt->bindParam(":recensementID", $this->recensementID);
        $stmt->bindParam(":nom_remettant", $this->nom_remettant);
        $stmt->bindParam(":nom_receptionaire", $this->nom_receptionaire);
        $stmt->bindParam(":date_livraison", $this->date_livraison);
        $stmt->bindParam(":id", $this->id);

        // Exécuter la requête
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Supprimer une livraison de district
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    public function getDetailsByFokontanyId($fokontany_id) {
        $query = "SELECT * FROM livraison_fokontany WHERE fokontanyID = :fokontany_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':fokontany_id', $fokontany_id);
        $stmt->execute();
        return $stmt;
    }
    public function readByCommune($communeId) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE commune_id = :commune_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':commune_id', $communeId);
        $stmt->execute();
        return $stmt;
    }

    
}


?>
