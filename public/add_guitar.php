<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../Classes/Authen.php';
require_once '../Classes/Guitar_class.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user = new User();
if (!$user->isAdmin($_SESSION['user_id'])) {
    echo "❌ you don't have right to pass！";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guitar = new Guitar();
    $added = $guitar->addGuitar($_POST['name'], $_POST['brand'], $_POST['price'], $_POST['stock']);
    
    if ($added) {
        echo "<p>✅ add success！</p>";
    } else {
        echo "<p>❌ falied try again。</p>";
    }
}
?>

<?php include '../view/header.php'; ?>

<h2>add new guitar</h2>
<form method="POST">
    <input type="text" name="name" placeholder="name" required><br>
    <input type="text" name="brand" placeholder="brand" required><br>
    <input type="number" name="price" placeholder="price" step="0.01" required><br>
    <input type="number" name="stock" placeholder="number" required><br>
    <button type="submit">add</button>
</form>

<?php include '../view/footer.php'; ?>
