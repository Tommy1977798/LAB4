<?php
require_once 'DB_Connect.php';

class Guitar {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAllGuitars() {
        $sql = "SELECT * FROM guitars";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addGuitar($name, $brand, $price, $stock) {
        $sql = "INSERT INTO guitars (name, brand, price, stock) VALUES (:name, :brand, :price, :stock)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['name' => $name, 'brand' => $brand, 'price' => $price, 'stock' => $stock]);
    }
}
?>
