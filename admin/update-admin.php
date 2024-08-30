<?php include('components/sidebar_header.php') ?>
<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql_check = "SELECT * FROM users WHERE user_id='{$id}'";
        $res_check = mysqli_query($conn, $sql_check);
        if($res_check){
            if(mysqli_num_rows($res_check)!=1){
                $_SERVER['stat'] = "Admin not found";
                $_SERVER['success'] = false;
                header(SITE_URL."admin/manage-admins.php?name=admins");
            }
        } else {
            $_SERVER['stat'] = "Error";
            $_SERVER['success'] = false;
            header(SITE_URL."admin/manage-admins.php?name=admins");
        }
        $admin = mysqli_fetch_assoc($res_check);
    } else {
        $_SERVER['stat'] = "Admin not found";
        $_SERVER['success'] = false;
        header(SITE_URL."admin/manage-admins.php?name=admins");
    }
    
?>
    <main>
        <h2><i class="fa-duotone fa-solid fa-user"></i></i> Update Admin</h2>
        <div class="form-container">
            <form action="" method="POST">
                <h3>Fill new admin's data</h3>
                
                <label>Usernmae: </label>
                <input type="text" name="username" id="username" class="input" placeholder="Enter New Admin Usernmae" value="<?php echo $admin['username']?>">
                <label>Email: </label>
                <input type="email" name="email" id="email" class="input" placeholder="Ex: name@email.example" value="<?php echo $admin['email']?>">
                <label>Password: </label>
                <input type="password" name="password" id="password" class="input" placeholder="Enter new or same password">
                <div class="buttons">
                    <input type="submit" value="update admin" class="submit set">
                    <input type="reset" value="reset" class="reset unset">
                </div>
            </form>
        </div>
    </main>


<?php
    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Function to sanitize input
    function sanitize_input($data) {
        return htmlspecialchars(trim($data));
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        try {
            $username = sanitize_input($_POST["username"]);
            $email = sanitize_input($_POST["email"]);
            $password = sanitize_input($_POST["password"]);
            
    
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
            if($password != ""){
                if (strlen($password) < 6) {
                    $errors[] = "Password must be at least 6 characters long.";
                }
            }
    
            if (empty($errors)) {
                // Hash the password
                $sql = "UPDATE users set username='{$username}', email='{$email}'";
                if($password!=""){
                    $hashed_password = md5($password);
                    $sql = $sql.", password_hash='{$hashed_password}'";
                }
                $sql = $sql."WHERE user_id = {$id}";
                $res = mysqli_query($conn,$sql);
                // Execute the statement
                if ($res) {
                    $_SESSION['stat'] = "update successful!";
                    $_SESSION['success'] = true;
                    header("location:".SITE_URL.'admin/manage-admins.php?&name=admins');
                } else {
                    $_SESSION['stat'] = "Error: " . mysqli_stmt_error($stmt);
                    $_SESSION['success'] = false;

                    header("location:".SITE_URL.'admin/update-admin.php?id='.$id.'&name=admins');
                }

            } else {
                $_SESSION['stat'] = $errors[0];
                $_SESSION['success'] = false;
                header("location:".SITE_URL.'admin/update-admin.php?id='.$id.'&name=admins');
            }
        
            
        } catch (mysqli_sql_exception $e){
            if ($e->getCode() == 1062) {
                $_SESSION['stat'] = "Error: The username or email is already in use.";
            } else {
                $_SESSION['stat'] = "Error: " . $e->getMessage();
            }
            $_SESSION['success'] = false;
            header("location:".SITE_URL.'admin/update-admin.php?id='.$id.'&name=admins');
        }
    }
?>

<?php include('components/footer.php') ?>
