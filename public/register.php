<?php
// session_start();
require_once '../Classes/Authen.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User();
    $register = $user->register($_POST['username'], $_POST['email'], $_POST['password']);

    if ($register) {
        echo "<p>✅ register success！<a href='login.php'>click to login</a></p>";
    } else {
        echo "<p>❌ the mail already been registed ,change one</p>";
    }
}
?>

<?php include '../view/header.php'; ?>

<h2>user sign in</h2>
<form method="POST">
    <input type="text" name="username" placeholder="用户名" required><br>
    <input type="email" name="email" placeholder="邮箱" required><br>
    <input type="password" name="password" placeholder="密码" required><br>
    <button type="submit">sign in</button>
</form>

<?php include '../view/footer.php'; ?>
