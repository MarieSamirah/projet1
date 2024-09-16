<?php
include_once 'Database.php';

class Fokontany
{
    private $conn;
    private $table_name = "fokontany";

    public $id;
    public $nom;
    public $nom_chef;
    public $contact;
    public $communeID;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Créer un nouveau fokontany
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET nom=:nom, nom_chef=:nom_chef, contact=:contact, communeID=:communeID";

        $stmt = $this->conn->prepare($query);

        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->nom_chef = htmlspecialchars(strip_tags($this->nom_chef));
        $this->contact = htmlspecialchars(strip_tags($this->contact));
        $this->communeID = htmlspecialchars(strip_tags($this->communeID));

        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":nom_chef", $this->nom_chef);
        $stmt->bindParam(":contact", $this->contact);
        $stmt->bindParam(":communeID", $this->communeID);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Lire tous les fokontany
    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

     //Read by region Id
     public function readByCommune($commune_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE communeID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $commune_id);
        $stmt->execute();

        return $stmt;
    }

    public function readJoin()
    {
        $query = "SELECT 
                f.Id AS fokontany_id, f.nom AS fokontany_nom, f.nom_chef AS chef, f.contact AS contact,
                c.nom AS commune_nom,
                d.nom AS district_nom,
                r.nom AS region_nom
            FROM 
                Fokontany f
            JOIN 
                Commune c ON f.communeID = c.Id
            JOIN 
                District d ON c.districtID = d.Id
            JOIN 
                Region r ON d.regionID = r.Id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function readJoinByCommune($communeID)
    {
        $query = "SELECT 
                f.Id AS fokontany_id, f.nom AS fokontany_nom, f.nom_chef AS chef, f.contact AS contact,
                c.nom AS commune_nom,
                d.nom AS district_nom,
                r.nom AS region_nom
            FROM 
                Fokontany f
            JOIN 
                Commune c ON f.communeID = c.Id
            JOIN 
                District d ON c.districtID = d.Id
            JOIN 
                Region r ON d.regionID = r.Id
            WHERE
                c.ID = $communeID";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function readJoinByDistrict($districtID)
    {
        $query = "SELECT 
                f.Id AS fokontany_id, f.nom AS fokontany_nom, f.nom_chef AS chef, f.contact AS contact,
                c.nom AS commune_nom,
                d.nom AS district_nom,
                r.nom AS region_nom
            FROM 
                Fokontany f
            JOIN 
                Commune c ON f.communeID = c.Id
            JOIN 
                District d ON c.districtID = d.Id
            JOIN 
                Region r ON d.regionID = r.Id
            WHERE
                d.Id = $districtID";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function readJoinByRegion($regionID)
    {
        $query = "SELECT 
                f.Id AS fokontany_id, f.nom AS fokontany_nom, f.nom_chef AS chef, f.contact AS contact,
                c.nom AS commune_nom,
                d.nom AS district_nom,
                r.nom AS region_nom
            FROM 
                Fokontany f
            JOIN 
                Commune c ON f.communeID = c.Id
            JOIN 
                District d ON c.districtID = d.Id
            JOIN 
                Region r ON d.regionID = r.Id
            WHERE
                r.Id = $regionID";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }


    // Lire un fokontany par ID
    public function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->nom = $row['nom'];
            $this->nom_chef = $row['nom_chef'];
            $this->contact = $row['contact'];
            $this->communeID = $row['communeID'];
        }
    }

    // Mettre à jour un fokontany
    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET nom = :nom, nom_chef = :nom_chef, contact = :contact WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->nom_chef = htmlspecialchars(strip_tags($this->nom_chef));
        $this->contact = htmlspecialchars(strip_tags($this->contact));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":nom_chef", $this->nom_chef);
        $stmt->bindParam(":contact", $this->contact);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Supprimer un fokontany
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
