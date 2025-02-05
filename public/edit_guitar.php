<?php
session_start();
require_once '../Classes/Authen.php';
require_once '../Classes/Guitar_class.php';

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

// 获取当前吉他信息
if (!isset($_GET['id'])) {
    echo "<p style='color:red;'>❌ Can not find guitar。</p>";
    exit;
}

$guitar_id = $_GET['id'];
$current_guitar = $guitar->getGuitarById($guitar_id);

if (!$current_guitar) {
    echo "<p style='color:red;'>❌ Guitar don't exit。</p>";
    exit;
}

// 处理更新吉他请求
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updated = $guitar->updateGuitar($guitar_id, $_POST['name'], $_POST['brand'], $_POST['price'], $_POST['stock']);
    if ($updated) {
        echo "<p style='color:green;'>✅ Update success！</p>";
        header("Location: add_guitar.php");
        exit;
    } else {
        echo "<p style='color:red;'>❌ Falied,try again please。</p>";
    }
}
?>

<?php include '../view/header.php'; ?>

<h2>Modify guitar</h2>
<form method="POST">
    <input type="text" name="name" value="<?php echo $current_guitar['name']; ?>" required><br>
    <input type="text" name="brand" value="<?php echo $current_guitar['brand']; ?>" required><br>
    <input type="number" name="price" value="<?php echo $current_guitar['price']; ?>" step="0.01" required><br>
    <input type="number" name="stock" value="<?php echo $current_guitar['stock']; ?>" required><br>
    <button type="submit">Update</button>
</form>

<?php include '../view/footer.php'; ?>
