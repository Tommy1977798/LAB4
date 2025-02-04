<?php 
require_once '../Classes/Order.php';
include '../view/header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$order = new Order();
$orders = $order->getOrdersByUser($_SESSION['user_id']);
?>

<h2>我的订单</h2>
<ul>
    <?php foreach ($orders as $order): ?>
        <li>订单号：<?php echo $order['id']; ?> - 总价：￥<?php echo $order['total_price']; ?> - 日期：<?php echo $order['created_at']; ?></li>
    <?php endforeach; ?>
</ul>

<?php include '../view/footer.php'; ?>
