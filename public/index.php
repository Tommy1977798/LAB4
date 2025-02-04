<?php 
require_once '../Classes/Guitar_class.php';
include '../view/header.php';

$guitar = new Guitar();
$guitars = $guitar->getAllGuitars();
?>

<h2>吉他列表</h2>
<ul>
    <?php foreach ($guitars as $g): ?>
        <li>
            <?php echo "{$g['name']} - {$g['brand']} - ￥{$g['price']}"; ?>
            <form action="cart.php" method="POST">
                <input type="hidden" name="guitar_id" value="<?php echo $g['id']; ?>">
                <input type="number" name="quantity" value="1" min="1">
                <button type="submit">加入购物车</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>

<?php include '../view/footer.php'; ?>
