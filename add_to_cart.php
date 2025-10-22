<?php
session_start();


if(!isset($_SESSION['user_id'])){
  header("Location: login.php");
  exit();
}

if(isset($_POST['name']) && isset($_POST['price']) && isset($_POST['image'])){
    $item = [
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'image' => $_POST['image']
    ];

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = $item;
}

header("Location: cart.php");
exit();
?>