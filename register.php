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
    <div class="container" style="flex-direction: row-reverse;">
        <form action="" method="POST">
            <h3>---- REGISTER ----</h3>
            <input type="text" name="username" id="username" placeholder="Enter a username" class="input">
            <input type="email" name="email" id="email" placeholder="Enter your email" class="input">
            <input type="password" name="password" id="password" placeholder="Enter a password"class="input">
            <input type="submit" value="REGISTER" class="btn">
            <a href="login.php" class="link"> LOGIN </a>
        </form>
        <img src="images/logo.jpeg" alt="The Cozy Corner Logo">
    </div>
</body>
</html>

<?php
    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Function to sanitize input
    function sanitize_input($data) {
        return htmlspecialchars(trim($data));
    }

    // Function to validate input
    function validate_input($username, $email, $password) {
        $errors = [];
        
        // Validate username
        if (empty($username) || strlen($username) < 3) {
            $errors[] = "Username must be at least 3 characters long.";
        }

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        // Validate password
        if (strlen($password) < 6) {
            $errors[] = "Password must be at least 6 characters long.";
        }
        
        return $errors;
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        try {
            $username = sanitize_input($_POST["username"]);
            $email = sanitize_input($_POST["email"]);
            $password = sanitize_input($_POST["password"]);
            $role = "user";
    
            $errors = validate_input($username, $email, $password);
    
            if (empty($errors)) {
                // Hash the password
                $hashed_password = md5($password);
        
                $stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password_hash, role) VALUES (?, ?, ?, ?)");
                mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashed_password, $role);
        
                // Execute the statement
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['stat'] = "Registration successful!";
                    $_SESSION['success'] = true;
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    header("location:".SITE_URL);
                } else {
                    $_SESSION['stat'] = "Error: " . mysqli_stmt_error($stmt);
                    $_SESSION['success'] = false;
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    header("location:".SITE_URL.'register.php');
                }

            } else {
                $_SESSION['stat'] = $errors[0];
                $_SESSION['success'] = false;
                mysqli_close($conn);
            }
        
            
        } catch (mysqli_sql_exception $e){
            if ($e->getCode() == 1062) {
                $_SESSION['stat'] = "Error: The username or email is already in use.";
            } else {
                $_SESSION['stat'] = "Error: " . $e->getMessage();
            }
            $_SESSION['success'] = false;
            header("location:".SITE_URL.'register.php');
        }
    }
?>