<?php
include_once 'Database.php';

class District {
    private $conn;
    private $table_name = "district";

    public $id;
    public $nom;
    public $regionID;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new district
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nom=:nom, regionID=:regionID";

        $stmt = $this->conn->prepare($query);

        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->regionID = htmlspecialchars(strip_tags($this->regionID));

        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":regionID", $this->regionID);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Read all districts
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    //Read by region Id
    public function readByRegion($region_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE regionID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $region_id);
        $stmt->execute();

        return $stmt;
    }

    // Read all districts
    public function readJoin() {
        $query = "SELECT 
                d.Id AS district_id, 
                d.nom AS district_nom, 
                d.regionID AS region_id,
                r.nom AS region_nom, 
                COUNT(DISTINCT c.Id) AS compte_commune,
                COUNT(f.Id) AS compte_fokontany
            FROM 
                District d
            JOIN 
                Region r ON d.regionID = r.Id
            LEFT JOIN 
                Commune c ON d.Id = c.districtID
            LEFT JOIN 
                Fokontany f ON c.Id = f.communeID
            GROUP BY 
                d.Id, d.nom, r.nom;";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Read all districts
    public function readJoinByRegion($regionID) {
        $query = "SELECT 
                d.Id AS district_id, 
                d.nom AS district_nom, 
                d.regionID AS region_id,
                r.nom AS region_nom, 
                COUNT(DISTINCT c.Id) AS compte_commune,
                COUNT(f.Id) AS compte_fokontany
            FROM 
                District d
            JOIN 
                Region r ON d.regionID = r.Id
            LEFT JOIN 
                Commune c ON d.Id = c.districtID
            LEFT JOIN 
                Fokontany f ON c.Id = f.communeID
            WHERE
                d.regionID = $regionID
            GROUP BY 
                d.Id, d.nom, r.nom;";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    
    // Read a single district by ID
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

    // Update a district
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nom = :nom, regionID =:regionID WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->regionID = htmlspecialchars(strip_tags($this->regionID));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":regionID", $this->regionID);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete a district
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
