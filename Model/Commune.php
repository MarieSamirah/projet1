<?php
include_once 'Database.php';


class Commune {
    private $conn;
    private $table_name = "commune";

    public $id;
    public $nom;
    public $type;
    public $districtID;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new commune
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nom=:nom, type=:type, districtID=:districtID";

        $stmt = $this->conn->prepare($query);

        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->districtID = htmlspecialchars(strip_tags($this->districtID));

        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":districtID", $this->districtID);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Read all communes
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    //Read by region Id
    public function readByDistrict($district_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE districtID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $district_id);
        $stmt->execute();

        return $stmt;
    }

    public function readJoin() {
        $query = "SELECT 
                c.Id AS commune_id, 
                c.nom AS commune_nom, 
                d.nom AS district_nom, 
                d.Id AS district_id, 
                r.nom AS region_nom,
                r.Id AS region_id, 
                COUNT(f.Id) AS compte_fokontany
            FROM 
                Commune c
            JOIN 
                District d ON c.districtID = d.Id
            JOIN 
                Region r ON d.regionID = r.Id
            LEFT JOIN 
                Fokontany f ON c.Id = f.communeID
            GROUP BY 
                c.Id, c.nom, d.nom, r.nom;
";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Read a single commune by ID
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->nom = $row['nom'];
            $this->type = $row['type'];
            $this->districtID = $row['districtID'];
        }
    }

    // Update a commune
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nom = :nom, type = :type, districtID = :districtID WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->districtID = htmlspecialchars(strip_tags($this->districtID));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":districtID", $this->districtID);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete a commune
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    public function readFokontanyByCommune($commune_id) {
        $query = "SELECT id, nom FROM fokontany WHERE commune_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $commune_id);
        $stmt->execute();
        return $stmt;
    }
    
   
}
?>
