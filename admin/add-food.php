<?php include('components/sidebar_header.php') ?>

    <main>
        <h2><i class="fa-solid fa-bowl-food"></i> Add Food</h2>
        <div class="form-container">
            <form action="" method="POST" enctype="multipart/form-data" id="form">
                <h3>Fill new Food's data</h3>
                
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

                <p>Price & category</p>
                <div class="buttons">
                    <input type="number" name="price" id="price" min="0" step="0.01" placeholder="add price" class="input">
                    <select name="food_category" id="food_category" class="input">
                        <option value="">no category</option>
                        <?php 
                            $sql = "SELECT id,title,active FROM categories ORDER BY active DESC,featured DESC";
                            $res = mysqli_query($conn,$sql);
                            if($res){
                                while($row=mysqli_fetch_assoc($res)){
                                    $color = $row['active']?"":"style=\"color: #777\"";
                                    echo "<option value=\"{$row['id']}\" {$color}>{$row['title']}</option>";
                                }
                            }
                        ?>
                    </select>
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
            $price = sanitize_input($_POST['price']);
            $category_id = !empty($_POST['category_id']) ? sanitize_input($_POST['category_id']) : NULL;
            $featured = isset($_POST['featured-box'])? 1 : 0;
            $active = isset($_POST['active-box'])? 1 : 0;
            $image_name = "";        
            if (empty($title)) {
                $_SESSION['stat'] = "the title is empty";
                $_SESSION['success'] = false;
                header("location:".SITE_URL.'admin/add-food.php?name=food');
            }


            if(isset($_FILES['image_name']['name']) && $_FILES['image_name']['error'] === UPLOAD_ERR_OK){
                $original_name = $_FILES['image_name']['name'];
                $ext = end(explode('.',$original_name));
                $image_name = "food_". date('Ymd_His') . '.' . $ext;
                $source_path = $_FILES['image_name']['tmp_name'];
                $distination = '../images/food/'.$image_name;

                $upload = move_uploaded_file($source_path, $distination);
                if(!$upload){
                    $_SESSION['stat'] = "Error: Couldn't Upload";
                    $_SESSION['success'] = false;
                    header("location:".SITE_URL.'admin/add-food.php?name=food');
                }
            }


    
            $stmt = mysqli_prepare($conn, "INSERT INTO foods (name, description, price, category_id, featured, active, image_name) VALUES (?, ?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Failed to prepare statement: " . mysqli_error($conn));
            }

            mysqli_stmt_bind_param($stmt, "ssiiiis", $title, $description, $price, $category_id, $featured, $active, $image_name);
            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['stat'] = "food added Succesfully";
                $_SESSION['success'] = true;
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("location:".SITE_URL.'admin/manage-food.php?name=food');
            } else {
                $_SESSION['stat'] = "Error: " . mysqli_stmt_error($stmt);
                $_SESSION['success'] = false;
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("location:".SITE_URL.'admin/add-food.php?name=food');
            }

            
        
            
        } catch (mysqli_sql_exception $e){
            $_SESSION['stat'] = "Error: Couldn't Add food". $e;
            $_SESSION['success'] = false;
            header("location:".SITE_URL.'admin/add-food.php?name=food');
        }
    }
?>

<?php include('Components/footer.php') ?>
