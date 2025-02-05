<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../Classes/Authen.php';
$user = new User();
?>



<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guitar Shop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    
    <h1>🎸Tommy's Guitar Shop</h1>
    <nav>
        <a href="index.php">main page</a>
        <a href="cart.php">cart</a>
        <?php if(isset($_SESSION['user_id'])): ?>
        <a href="order.php">my order</a>
        <?php if($user->isAdmin($_SESSION['user_id'])): ?>
            <a href="add_guitar.php">add guitar(Administrater only)</a>
        <?php endif; ?>
        <a href="logout.php">sign out</a>
    <?php else: ?>
        <a href="login.php">log in</a>
        <a href="register.php">resgiter</a>
    <?php endif; ?>
    </nav>
</header>

<main>
