<?php
include_once 'Database.php';

class Region {
    private $conn;
    private $table_name = "region";

    public $id;
    public $nom;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Créer une nouvelle région
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nom=:nom";

        $stmt = $this->conn->prepare($query);

        $this->nom = htmlspecialchars(strip_tags($this->nom));

        $stmt->bindParam(":nom", $this->nom);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Lire toutes les régions
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    
    public function readJoin() {
        $query = "SELECT 
            r.Id AS region_id, 
            r.nom AS region_nom, 
            COUNT(DISTINCT d.Id) AS compte_district,
            COUNT(DISTINCT c.Id) AS compte_commune,
            COUNT(f.Id) AS compte_fokontany
        FROM 
            Region r
        LEFT JOIN 
            District d ON r.Id = d.regionID
        LEFT JOIN 
            Commune c ON d.Id = c.districtID
        LEFT JOIN 
            Fokontany f ON c.Id = f.communeID
        GROUP BY 
            r.Id, r.nom";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    // Lire une région par ID
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->nom = $row['nom'];
        }
    }

    // Mettre à jour une région
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nom = :nom WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Supprimer une région
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
