<?php include('components/sidebar_header.php') ?>

    <main>
        <h2><i class="fa-solid fa-basket-shopping"></i> Add Category</h2>
        <div class="form-container">
            <form action="" method="POST" enctype="multipart/form-data" id="form">
                <h3>Fill new Category's data</h3>
                
                <label for="title">Title</label>
                <input required type="text" name="title" id="title" class="input" placeholder="Enter New Category title">
                
                <label for="description">Description</label>
                <textarea name="description" id="description"></textarea>
                
                <p>adding an image</p>
                <div class="buttons">
                    <input type="file" name="image_name" id="image_name" accept="image/*">
                    <label for="image_name" class="btn set"><i class="fa-solid fa-plus"></i> Add Image</label>
                    <span id="fileName">No image chosen</span>
                </div>
                
                <p>Display settings</p>
                <div class="buttons radio-btn">
                    <label for="featured-box" class="btn unset" id="featured-btn">featured</label>
                    <input type="checkbox" name="featured-box" id="featured-box">
                    
                    <label for="active-box" class="btn unset" id="active-btn">active</label>
                    <input type="checkbox" name="active-box" id="active-box">
                </div>
                <br>
                <div class="buttons">
                    <input type="submit" value="add category" class="submit set">
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
            $title = sanitize_input($_POST["title"]);
            $description = sanitize_input($_POST["description"]);
            $featured = isset($_POST['featured-box'])? 1 : 0;
            $active = isset($_POST['active-box'])? 1 : 0;
            $image_name = "";        
            if (empty($title)) {
                $_SESSION['stat'] = "the title is empty";
                $_SESSION['success'] = false;
                header("location:".SITE_URL.'admin/add-category.php?name=categories');
            }


            if(isset($_FILES['image_name']['name']) && $_FILES['image_name']['error'] === UPLOAD_ERR_OK){
                $image_name = $_FILES['image_name']['name'];
                $source_path = $_FILES['image_name']['tmp_name'];
                $distination = '../images/categories/'.$image_name;

                $upload = move_uploaded_file($source_path, $distination);
                if(!$upload){
                    $_SESSION['stat'] = "Error: Couldn't Upload";
                    $_SESSION['success'] = false;
                    header("location:".SITE_URL.'admin/add-category.php?name=categories');
                }
            }


    
            $stmt = mysqli_prepare($conn, "INSERT INTO categories (title, description, featured, active, image_name) VALUES (?, ?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Failed to prepare statement: " . mysqli_error($conn));
            }

            mysqli_stmt_bind_param($stmt, "ssiis", $title, $description, $featured, $active, $image_name);
            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['stat'] = "Category added Succesfully";
                $_SESSION['success'] = true;
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("location:".SITE_URL.'admin/manage-categories.php?name=categories');
            } else {
                $_SESSION['stat'] = "Error: " . mysqli_stmt_error($stmt);
                $_SESSION['success'] = false;
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("location:".SITE_URL.'admin/add-category.php?name=categories');
            }

            
        
            
        } catch (mysqli_sql_exception $e){
            $_SESSION['stat'] = "Error: Couldn't Add category";
            $_SESSION['success'] = false;
            header("location:".SITE_URL.'admin/add-category.php?name=categories');
        }
    }
?>

<?php include('Components/footer.php') ?>
