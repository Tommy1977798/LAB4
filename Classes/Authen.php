<?php
require_once 'DB_Connect.php';

class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }



    public function isAdmin($user_id) {
        $sql = "SELECT role FROM users WHERE id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user && $user['role'] === 'admin';
    }

    
    public function register($username, $email, $password) {
        // 检查用户是否已存在
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        if ($stmt->rowCount() > 0) {
            return false; // 邮箱已存在
        }
    
        // 加密密码
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
        // 插入新用户
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashed_password
        ]);
    }
    

    public function login($email, $password) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            var_dump($user['password']); // 输出数据库中的哈希密码
            if (password_verify($password, $user['password'])) {
                return $user;
            } else {
                echo "❌ password wrong";
            }
        } else {
            echo "❌ account don't exit";
        }
        return false;
    }
    
}
?>
