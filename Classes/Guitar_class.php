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

    public function deleteGuitar($id) {
    $sql = "DELETE FROM guitars WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute(['id' => $id]);
}


    public function getGuitarById($id) {
    $sql = "SELECT * FROM guitars WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function updateGuitar($id, $name, $brand, $price, $stock) {
    $sql = "UPDATE guitars SET name = :name, brand = :brand, price = :price, stock = :stock WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
        'id' => $id,
        'name' => $name,
        'brand' => $brand,
        'price' => $price,
        'stock' => $stock
    ]);
}

}
?>
