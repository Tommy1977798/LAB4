<?php
session_start();
require_once '../Classes/Authen.php';
require_once '../classes/Guitar_class.php';

// 确保用户已登录
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// 检查是否是管理员
$user = new User();
if (!$user->isAdmin($_SESSION['user_id'])) {
    echo "<p style='color:red;'>❌ you don't have previliege to visit this page！</p>";
    exit;
}

$guitar = new Guitar();

// 处理删除吉他请求
if (isset($_GET['delete'])) {
    $guitar_id = $_GET['delete'];
    $guitar->deleteGuitar($guitar_id);
    header("Location: add_guitar.php");
    exit;
}

// 处理添加吉他请求
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $added = $guitar->addGuitar($_POST['name'], $_POST['brand'], $_POST['price'], $_POST['stock']);
    if ($added) {
        echo "<p style='color:green;'>✅ add guitar success！</p>";
    } else {
        echo "<p style='color:red;'>❌ add falied , try again。</p>";
    }
}

// 获取所有吉他
$guitars = $guitar->getAllGuitars();
?>

<?php include '../view/header.php'; ?>

<h2>Add new guitar</h2>
<form method="POST">
    <input type="text" name="name" placeholder="NAME" required><br>
    <input type="text" name="brand" placeholder="BRAND" required><br>
    <input type="number" name="price" placeholder="PRICE" step="0.01" required><br>
    <input type="number" name="stock" placeholder="STOCK NUMBER" required><br>
    <button type="submit" name="add">add</button>
</form>

<h2>🎸 Guitar List</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Brand</th>
        <th>Price</th>
        <th>Stock Number</th>
        <th>Modify</th>
    </tr>
    <?php foreach ($guitars as $g): ?>
        <tr>
            <td><?php echo $g['id']; ?></td>
            <td><?php echo $g['name']; ?></td>
            <td><?php echo $g['brand']; ?></td>
            <td>￥<?php echo $g['price']; ?></td>
            <td><?php echo $g['stock']; ?></td>
            <td>
                <a href="edit_guitar.php?id=<?php echo $g['id']; ?>">Modify</a> |
                <a href="add_guitar.php?delete=<?php echo $g['id']; ?>" onclick="return confirm('Are you sure to delete this one？');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include '../view/footer.php'; ?>
