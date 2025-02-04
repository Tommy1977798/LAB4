<?php 
require_once '../Classes/Cart.php';
include '../view/header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$cart = new Cart();
$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cart->addToCart($user_id, $_POST['guitar_id'], $_POST['quantity']);
}

$cart_items = $cart->viewCart($user_id);
?>

<h2>购物车</h2>
<ul>
    <?php foreach ($cart_items as $item): ?>
        <li><?php echo "{$item['name']} - 数量: {$item['quantity']} - 总价: ￥" . ($item['price'] * $item['quantity']); ?></li>
    <?php endforeach; ?>
</ul>

<form action="checkout.php" method="POST">
    <button type="submit">结账</button>
</form>

<?php include '../view/footer.php'; ?>
