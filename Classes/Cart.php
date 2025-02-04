<?php
require_once 'DB_Connect.php';

class Cart {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function addToCart($user_id, $guitar_id, $quantity) {
        $sql = "INSERT INTO cart (user_id, guitar_id, quantity) VALUES (:user_id, :guitar_id, :quantity)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['user_id' => $user_id, 'guitar_id' => $guitar_id, 'quantity' => $quantity]);
    }

    public function viewCart($user_id) {
        $sql = "SELECT guitars.name, guitars.price, cart.quantity 
                FROM cart 
                JOIN guitars ON cart.guitar_id = guitars.id 
                WHERE cart.user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removeFromCart($user_id, $guitar_id) {
        $sql = "DELETE FROM cart WHERE user_id = :user_id AND guitar_id = :guitar_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['user_id' => $user_id, 'guitar_id' => $guitar_id]);
    }
}
?>
