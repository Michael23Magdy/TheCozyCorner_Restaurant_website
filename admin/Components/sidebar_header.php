<?php include('../config/constants.php') ?>
<?php include('login_check.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard : The Cozy Corner</title>
    <link rel="icon" href="../images/logo.png" type="image/png">

    <!-- Render all elements normally -->
    <link rel="stylesheet" href="../css/normalize.css">

    <!-- main styling -->
    <link rel="stylesheet" href="css/dashboard.css">

    <!-- Font Awesome Library -->
    <link rel="stylesheet" href="../css/all.min.css">


</head>
<body>
    <div class="container">
        <aside id="sidebar">
            <div class="logo">
                <img src="../images/logo.jpeg" alt="">
            </div>
            <h2>Manage Databases</h2>
            <ul>
                <li><a href="index.php?name=home" <?php if(empty($_GET['name'])||$_GET['name']== "home") echo "class='current-page'"?>>Home</a></li>
                <li><a href="manage-admins.php?name=admins" <?php if(!empty($_GET['name']) && $_GET['name']== "admins") echo "class='current-page'"?>>Admins</a></li>
                <li><a href="manage-categories.php?name=categories" <?php if(!empty($_GET['name']) && $_GET['name']== "categories") echo "class='current-page'"?>>Categories</a></li>
                <li><a href="manage-food.php?name=food" <?php if(!empty($_GET['name']) && $_GET['name']== "food") echo "class='current-page'"?>>Food</a></li>
                <li><a href="manage-orders.php?name=orders" <?php if(!empty($_GET['name']) && $_GET['name']== "orders") echo "class='current-page'"?>>Orders</a></li>
                <li><a href="manage-users.php?name=users" <?php if(!empty($_GET['name']) && $_GET['name']== "users") echo "class='current-page'"?>>users</a></li>
                <li><a href="../logout.php" >Logout</a></li>
            </ul>
        </aside>
        <div class="content">
            <header>
                <i class="fa-solid fa-bars" onclick="toggleSidebar()"></i>
                <h1>Dashboard</h1>
            </header>
<?php 
    include('notification.php');
?>