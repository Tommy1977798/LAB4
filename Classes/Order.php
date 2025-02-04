<?php
require_once 'DB_Connect.php';

class Order {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // 下订单
    public function placeOrder($user_id) {
        $this->conn->beginTransaction(); // 开始数据库事务，保证数据一致性

        try {
            // 获取购物车商品
            $sql = "SELECT guitars.id, guitars.price, cart.quantity 
                    FROM cart 
                    JOIN guitars ON cart.guitar_id = guitars.id 
                    WHERE cart.user_id = :user_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['user_id' => $user_id]);
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($items)) {
                throw new Exception("your cart is empty，无法结账！");
            }

            // 计算订单总价
            $total_price = 0;
            foreach ($items as $item) {
                $total_price += $item['price'] * $item['quantity'];
            }

            // 创建订单
            $sql = "INSERT INTO orders (user_id, total_price) VALUES (:user_id, :total_price)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['user_id' => $user_id, 'total_price' => $total_price]);
            $order_id = $this->conn->lastInsertId(); // 获取新订单的ID

            // 插入订单商品
            foreach ($items as $item) {
                $sql = "INSERT INTO order_items (order_id, guitar_id, quantity, price) 
                        VALUES (:order_id, :guitar_id, :quantity, :price)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([
                    'order_id' => $order_id,
                    'guitar_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);

                // 更新库存
                $sql = "UPDATE guitars SET stock = stock - :quantity WHERE id = :guitar_id";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([
                    'quantity' => $item['quantity'], 
                    'guitar_id' => $item['id']
                ]);
            }

            // 清空购物车
            $sql = "DELETE FROM cart WHERE user_id = :user_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['user_id' => $user_id]);

            $this->conn->commit(); // 事务提交
            return "order submit success，order id：$order_id";
        } catch (Exception $e) {
            $this->conn->rollBack(); // 发生错误时回滚事务
            return "order submit failed：" . $e->getMessage();
        }
    }

    // 获取用户订单列表
    public function getOrdersByUser($user_id) {
        $sql = "SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
