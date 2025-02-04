<?php 
require_once '../Classes/Order.php';
include '../view/header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$order = new Order();
$message = $order->placeOrder($_SESSION['user_id']);
echo "<h2>$message</h2>";

include '../view/footer.php';
?>
