<?php
include_once 'Database.php';

class LivraisonFokontany {
    private $conn;
    private $table_name = "livraison_fokontany";

    public $id;
    public $nombre_recensement;
    public $nombre_recu;
    public $nombre_doublon;
    public $nombre_distribue;
    public $nombre_reste_distribue;
    public $nombre_autre_anomalie;
    public $date_livraison;
    public $fokontanyID;
    public $observation;
    public $recensementID;


    public function __construct($db) {
        $this->conn = $db;
    }

    // Créer une nouvelle livraison pour un fokontany
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nombre_recensement=:nombre_recensement , nombre_recu=:nombre_recu, nombre_doublon=:nombre_doublon, nombre_distribue=:nombre_distribue, nombre_reste_distribue=:nombre_reste_distribue, nombre_autre_anomalie=:nombre_autre_anomalie, date_livraison=:date_livraison, fokontanyID=:fokontanyID, observation=:observation, recensementID=:recensementID";

        $stmt = $this->conn->prepare($query);

        $this->nombre_recensement = htmlspecialchars(strip_tags($this->nombre_recensement));
        $this->nombre_recu = htmlspecialchars(strip_tags($this->nombre_recu));
        $this->nombre_doublon = htmlspecialchars(strip_tags($this->nombre_doublon));
        $this->nombre_distribue = htmlspecialchars(strip_tags($this->nombre_distribue));
        $this->nombre_reste_distribue = htmlspecialchars(strip_tags($this->nombre_reste_distribue));
        $this->nombre_autre_anomalie = htmlspecialchars(strip_tags($this->nombre_autre_anomalie));
        $this->date_livraison = htmlspecialchars(strip_tags($this->date_livraison));
        $this->fokontanyID = htmlspecialchars(strip_tags($this->fokontanyID));
        $this->observation = htmlspecialchars(strip_tags($this->observation));
        $this->recensementID = htmlspecialchars(strip_tags($this->recensementID));

        $stmt->bindParam(":nombre_recensement", $this->nombre_recensement);
        $stmt->bindParam(":nombre_recu", $this->nombre_recu);
        $stmt->bindParam(":nombre_doublon", $this->nombre_doublon);
        $stmt->bindParam(":nombre_distribue", $this->nombre_distribue);
        $stmt->bindParam(":nombre_reste_distribue", $this->nombre_reste_distribue);
        $stmt->bindParam(":nombre_autre_anomalie", $this->nombre_autre_anomalie);
        $stmt->bindParam(":date_livraison", $this->date_livraison);
        $stmt->bindParam(":fokontanyID", $this->fokontanyID);
        $stmt->bindParam(":observation", $this->observation);
        $stmt->bindParam(":recensementID", $this->recensementID);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Lire toutes les livraisons de fokontany
    public function read($recensement) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE recensementID = $recensement";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Lire toutes les livraisons de fokontany par commune
    public function readByCommune($recensement, $communeID) {
        $query = "SELECT * FROM livraison_fokontany WHERE (recensementID = $recensement) AND fokontanyId IN (SELECT id FROM fokontany WHERE communeID = ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $communeID);
        $stmt->execute();

        return $stmt;
    }
    
    // Lire toutes les livraisons de fokontany par district
    public function readByDistrict($recensement, $districtID) {
        $query = "SELECT * FROM livraison_fokontany WHERE (recensementID = $recensement) AND fokontanyId IN (SELECT id FROM fokontany WHERE communeID IN (SELECT id FROM Commune WHERE districtID = ?))";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $districtID);
        $stmt->execute();

        return $stmt;
    }

    // Lire toutes les livraisons de fokontany par Region
    public function readByRegion($recensement, $communeID) {
        $query = "SELECT * FROM livraison_fokontany WHERE (recensementID = $recensement) AND fokontanyId IN (SELECT id FROM fokontany WHERE communeID IN (SELECT id FROM Commune WHERE districtID IN (SELECT id FROM district WHERE regionID = ?)))";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $communeID);
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
            $this->nombre_recensement = $row['nombre_recensement'];
            $this->nombre_recu = $row['nombre_recu'];
            $this->nombre_doublon = $row['nombre_doublon'];
            $this->nombre_distribue = $row['nombre_distribue'];
            $this->nombre_reste_distribue = $row['nombre_reste_distribue'];
            $this->nombre_autre_anomalie = $row['nombre_autre_anomalie'];
            $this->date_livraison = $row['date_livraison'];
            $this->fokontanyID = $row['fokontanyID'];
            $this->observation = $row['observation'];

        }
    }

    // Mettre à jour une livraison de fokontany
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nombre_recensement = :nombre_recensement, nombre_recu = :nombre_recu, nombre_doublon = :nombre_doublon, nombre_distribue = :nombre_distribue, nombre_reste_distribue = :nombre_reste_distribue, nombre_autre_anomalie = :nombre_autre_anomalie, date_livraison = :date_livraison, fokontanyID = :fokontanyID , observation = :observation WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->nombre_recensement = htmlspecialchars(strip_tags($this->nombre_recensement));
        $this->nombre_recu = htmlspecialchars(strip_tags($this->nombre_recu));
        $this->nombre_doublon = htmlspecialchars(strip_tags($this->nombre_doublon));
        $this->nombre_distribue = htmlspecialchars(strip_tags($this->nombre_distribue));
        $this->nombre_reste_distribue = htmlspecialchars(strip_tags($this->nombre_reste_distribue));
        $this->nombre_autre_anomalie = htmlspecialchars(strip_tags($this->nombre_autre_anomalie));
        $this->date_livraison = htmlspecialchars(strip_tags($this->date_livraison));
        $this->fokontanyID = htmlspecialchars(strip_tags($this->fokontanyID));
        $this->observation = htmlspecialchars(strip_tags($this->observation));
        $this->id = htmlspecialchars(strip_tags($this->id));


        $stmt->bindParam(":nombre_recensement", $this->nombre_recensement);
        $stmt->bindParam(":nombre_recu", $this->nombre_recu);
        $stmt->bindParam(":nombre_doublon", $this->nombre_doublon);
        $stmt->bindParam(":nombre_distribue", $this->nombre_distribue);
        $stmt->bindParam(":nombre_reste_distribue", $this->nombre_reste_distribue);
        $stmt->bindParam(":nombre_autre_anomalie", $this->nombre_autre_anomalie);
        $stmt->bindParam(":date_livraison", $this->date_livraison);
        $stmt->bindParam(":fokontanyID", $this->fokontanyID);
        $stmt->bindParam(":observation", $this->observation);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Supprimer une livraison de fokontany
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    // Méthode pour obtenir le nom du fokontany par ID
    public function getFokontanyName($fokontanyID) {
        $query = "SELECT nom FROM fokontany WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $fokontanyID);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['nom'] ?? 'Inconnu'; // Retourne 'Inconnu' si le nom n'est pas trouvé
    }
    public function getTotals() {
        $query = "SELECT 
                    SUM(nombre_recensement) AS total_recensement,
                    SUM(nombre_recu) AS total_recu,
                    SUM(nombre_doublon) AS total_doublon,
                    SUM(nombre_distribue) AS total_distribue,
                    SUM(nombre_reste_distribue) AS total_reste_distribue,
                    SUM(nombre_autre_anomalie) AS total_anomalie
                  FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTotalLivraisonFokontany($recensementID) {
        $query = "SELECT 
                    SUM(nombre_recensement) AS total_recensement,
                    SUM(nombre_recu) AS total_recu,
                    SUM(nombre_doublon) AS total_doublon,
                    SUM(nombre_distribue) AS total_distribue,
                    SUM(nombre_reste_distribue) AS total_reste_distribue,
                    SUM(nombre_autre_anomalie) AS total_anomalie
                  FROM " . $this->table_name . " WHERE recensementID = $recensementID";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

