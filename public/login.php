<?php
session_start();
require_once '../classes/Authen.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User();
    $login = $user->login($_POST['email'], $_POST['password']);

    if ($login) {
        $_SESSION['user_id'] = $login['id'];
        $_SESSION['username'] = $login['username'];
        header("Location: index.php");
        exit;
    } else {
        echo "<p>⚠️ login failed，please check email or password。</p>";
    }
}
?>


<h2>login</h2>
<form method="POST">
    <input type="email" name="email" placeholder="email" required><br>
    <input type="password" name="password" placeholder="password" required><br>
    <button type="submit">登录</button>
</form>

<?php include '../view/footer.php'; ?>
