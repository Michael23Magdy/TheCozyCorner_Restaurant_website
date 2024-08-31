<?php include('components/sidebar_header.php');
    ob_start(); ?>
<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql_check = "SELECT * FROM foods WHERE id='{$id}'";
        $res_check = mysqli_query($conn, $sql_check);
        if($res_check){
            if(mysqli_num_rows($res_check)!=1){
                $_SERVER['stat'] = "food not found";
                $_SERVER['success'] = false;
                header(SITE_URL."admin/manage-food.php?name=foods");
            }
        } else {
            $_SERVER['stat'] = "Error";
            $_SERVER['success'] = false;
            header(SITE_URL."admin/manage-food.php?name=foods");
        }
        $food = mysqli_fetch_assoc($res_check);
        $is_featured = $food['featured']==1;
        $is_active = $food['active']==1;
    } else {
        $_SERVER['stat'] = "food not found";
        $_SERVER['success'] = false;
        header(SITE_URL."admin/manage-food.php?name=food");
    }
?>
    <main>
        <h2><i class="fa-solid fa-bowl-food"></i> Update Food</h2>
        <div class="form-container">
            <form action="" method="POST" enctype="multipart/form-data" id="form">
                <h3>Fill new Food's data</h3>
                
                <label for="title">Title</label>
                <input required type="text" value="<?php echo $food['name']?>"
                    name="title" id="title" class="input" placeholder="Enter New Category title">
                
                <label for="description">Description</label>
                <textarea name="description" id="description">
                    <?php echo $food['description'] ?>
                </textarea>
                
                <p>adding an image</p>
                <div class="buttons">
                    <input type="file" name="image_name" id="image_name" accept="image/*">
                    <label for="image_name" class="btn set"><i class="fa-solid fa-plus"></i> Change Image</label>
                    <span id="fileName">No image chosen</span>
                </div>
                <?php if(!empty($food['image_name'])){
                    echo "
                        <div class=\"current-image\">
                            <img src=\"../images/food/{$food['image_name']}\" alt=\"old image\" width=\"150px\">
                        </div>
                    ";
                } ?>

                <p>Price & category</p>
                <div class="buttons">
                    <input type="number" name="price" value="<?php echo $food['price']?>" id="price" min="0" step="0.01" placeholder="add price" class="input">
                    <select name="food_category" id="food_category" class="input">
                        <option value="">no category</option>
                        <?php 
                            $sql = "SELECT id,title,active FROM categories ORDER BY active DESC,featured DESC";
                            $res = mysqli_query($conn,$sql);
                            if($res){
                                while($row=mysqli_fetch_assoc($res)){
                                    $color = $row['active']?"":"style=\"color: #777\"";
                                    $selected = $row['id']==$food['category_id']?"selected":"";
                                    echo "<option $selected value=\"{$row['id']}\" {$color}>{$row['title']}</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                
                <p>Display settings</p>
                <div class="buttons radio-btn">
                    <label for="featured-box" class="btn <?php if($is_featured) echo "set"; else echo "unset";?>" 
                        id="featured-btn">featured</label>
                    <input type="checkbox" name="featured-box" id="featured-box" <?php if($is_featured) echo "checked"?>>
                    
                    <label for="active-box" class="btn <?php if($is_active) echo "set"; else echo "unset";?>" 
                        id="active-btn">active</label>
                    <input type="checkbox" name="active-box" id="active-box" <?php if($is_active) echo "checked"?>>
                </div>
                <br>
                <div class="buttons">
                    <input type="submit" value="update food" class="submit set">
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
            $category_id = !empty($_POST['food_category']) ? sanitize_input($_POST['food_category']) : NULL;
            $featured = isset($_POST['featured-box'])? 1 : 0;
            $active = isset($_POST['active-box'])? 1 : 0;
            $image_name = "";       
            if (empty($title)) {
                $_SESSION['stat'] = "the title is empty";
                $_SESSION['success'] = false;
                header("location:".SITE_URL.'admin/add-food.php?name=food');
            }


            if(isset($_FILES['image_name']['name']) && $_FILES['image_name']['error'] === UPLOAD_ERR_OK){
                // delete old image
                if(!empty($food['image_name'])){
                    $remove = unlink("../images/food/".$food['image_name']);
                    if(!$remove){
                        $_SESSION['stat'] = "Couldn't delete image";
                        $_SESSION['success'] = false;
                        header('location:'.SITE_URL."/admin/manage-food.php?name=food");
                        die();
                    }
                }

                // upload new image
                $original_name = $_FILES['image_name']['name'];
                $name_parts = explode('.', $original_name);
                $ext = end($name_parts);
                $image_name = "food_". date('Ymd_His') . '.' . $ext;
                $source_path = $_FILES['image_name']['tmp_name'];
                $distination = '../images/food/'.$image_name;

                $upload = move_uploaded_file($source_path, $distination);
                if(!$upload){
                    $_SESSION['stat'] = "Error: Couldn't Upload";
                    $_SESSION['success'] = false;
                    header("location:".SITE_URL.'admin/add-food.php?name=food');
                    die();
                }
            }

            $sql = "UPDATE foods 
            SET name='{$title}',description='{$description}',price='{$price}', category_id='{$category_id}',featured='{$featured}',active='{$active}'";
            if(!empty($image_name)){
                $sql = $sql.",image_name='{$image_name}'";
            }
            $sql = $sql."WHERE id = {$id}";
            $res = mysqli_query($conn, $sql);
            
            
            if ($res) {
                $_SESSION['stat'] = "Food Updated Succesfully";
                $_SESSION['success'] = true;
                header("location:".SITE_URL.'admin/manage-food.php?name=food');
            } else {
                $_SESSION['stat'] = "Error: " . mysqli_stmt_error($stmt);
                $_SESSION['success'] = false;
                header("location:".SITE_URL.'admin/update-food.php?id='.$id.'&name=food');
            }

            
        
            
        } catch (mysqli_sql_exception $e){
            $_SESSION['stat'] = "Error: Couldn't Update category";
            $_SESSION['success'] = false;
            header("location:".SITE_URL.'admin/update-category.php?id='.$id.'&name=categories');
        }
    }

    ob_end_flush();
?>

<?php include('Components/footer.php') ?>
