<?php 
    include('config/constants.php') ;
    include('admin/Components/notification.php') ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="icon" href="images/logo.png" type="image/png">

    <!-- Render all elements normally -->
    <link rel="stylesheet" href="../css/normalize.css">

    <!-- main styling -->
    <link rel="stylesheet" href="css/login.css">

    <!-- Font Awesome Library -->
    <link rel="stylesheet" href="../css/all.min.css">
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <h3>---- Login ----</h3>
            <input type="text" name="username" id="username" placeholder="Enter your username" class="input">
            <input type="password" name="password" id="password" placeholder="Enter your password"class="input">
            <input type="submit" value="LOGIN" class="btn">
            <a href="register.php" class="link"> REGISTER </a>
        </form>
        <img src="images/logo.jpeg" alt="The Cozy Corner Logo">
    </div>
</body>
</html>

<?php

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashed_passwrod = md5($password);

        $sql = "SELECT * FROM users WHERE username='{$username}' AND password_hash='{$hashed_passwrod}'";
        $res = mysqli_query($conn,$sql);
        if($res){
            $count = mysqli_num_rows($res);
            if($count==1){
                $user = mysqli_fetch_assoc($res);
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['stat'] = "Login Successful";
                $_SESSION['success'] = true;
                if($_SESSION['role']=="admin"){
                    header("location:".SITE_URL."admin/");
                } else {
                    header("location:".SITE_URL);
                }
            } else {
                $_SESSION['stat'] = "Login Failed";
                $_SESSION['success'] = false;
                header("location:".SITE_URL."login.php");
            }
        } else {
            $_SESSION['stat'] = "Login Failed";
            $_SESSION['success'] = false;
            header("location:".SITE_URL."login.php");
        }
    }

?>