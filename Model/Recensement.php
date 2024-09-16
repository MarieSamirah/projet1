<?php
include_once 'Database.php';

class Recensement {
    private $conn;
    private $table_name = "recensement";

    public $id;
    public $nom_recensement;
    public $observation;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Créer un nouveau recensement
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nom_recensement=:nom_recensement, observation=:observation, status=:status";

        $stmt = $this->conn->prepare($query);

        $this->nom_recensement = htmlspecialchars(strip_tags($this->nom_recensement));
        $this->observation = htmlspecialchars(strip_tags($this->observation));
        $this->status = htmlspecialchars(strip_tags($this->status));

        $stmt->bindParam(":nom_recensement", $this->nom_recensement);
        $stmt->bindParam(":observation", $this->observation);
        $stmt->bindParam(":status", $this->status);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Lire tous les recensements
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Lire tous les recensements avec status active
    public function readAllActive() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE status='active'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Lire un recensement par ID
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->nom_recensement = $row['nom_recensement'];
        }
    }

    // Mettre à jour un recensement
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nom_recensement = :nom_recensement, observation =:observation, status=:status WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->nom_recensement = htmlspecialchars(strip_tags($this->nom_recensement));
        $this->observation = htmlspecialchars(strip_tags($this->observation));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":nom_recensement", $this->nom_recensement);
        $stmt->bindParam(":observation", $this->observation);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Supprimer un recensement
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
