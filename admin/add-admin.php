<?php include('components/sidebar_header.php') ?>
<?php 
    if(isset($_SESSION['stat'])){
        echo "<p class=\"fail msg\"> *{$_SESSION['stat']} </p>";
        unset($_SESSION['stat']);
    }
?>
    <main>
        <h2><i class="fa-duotone fa-solid fa-user"></i></i> Add Admin</h2>
        <div class="form-container">
            <form action="" method="POST">
                <h3>Fill new admin's data</h3>
                
                <label>Usernmae: </label>
                <input type="text" name="username" id="username" class="input" placeholder="Enter New Admin Usernmae">
                <label>Email: </label>
                <input type="email" name="email" id="email" class="input" placeholder="Ex: name@email.example">
                <label>Password: </label>
                <input type="password" name="password" id="password" class="input" placeholder="Enter a strong password">
                <div class="buttons">
                    <input type="submit" value="add admin" class="submit">
                    <input type="reset" value="reset" class="reset">
                </div>
            </form>
        </div>
    </main>

<?php include('components/footer.php') ?>

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
            $role = "admin";
    
            $errors = validate_input($username, $email, $password);
    
            if (empty($errors)) {
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
                $stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password_hash, role) VALUES (?, ?, ?, ?)");
                mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashed_password, $role);
        
                // Execute the statement
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['stat'] = "Registration successful!";
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    header("location:".SITE_URL.'admin/manage-admins.php');
                } else {
                    $_SESSION['stat'] = "Error: " . mysqli_stmt_error($stmt);
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    header("location:".SITE_URL.'admin/add-admin.php');
                }

            } else {
                $_SESSION['stat'] = $errors;
                mysqli_close($conn);
            }
        
            
        } catch (mysqli_sql_exception $e){
            if ($e->getCode() == 1062) {
                $_SESSION['stat'] = "Error: The username or email is already in use.";
            } else {
                $_SESSION['stat'] = "Error: " . $e->getMessage();
            }
            header("location:".SITE_URL.'admin/add-admin.php');
        }
    }
?>