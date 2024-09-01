<?php
    function print_food_card($title, $image_name, $price, $description, $id){
        $url =  isset($_SESSION['username'])? "": SITE_URL."login.php";
        if(empty($category_name)) $category_name = "no category selected";
        $image_url = empty($image_name)? "https://placehold.co/250x300?text=No+Image": "images/food/{$image_name}";
        echo "
            <div class=\"food-card card\"
                style=\"background: url('{$image_url}')\">
                <h3>{$title}</h3>
                <div class=\"details\">
                    <p class=\"price\">$ {$price}</p>
                    <p class=\"des\">{$description}</p>
                    <div>
                        <a href=\"{$url}\" class=\"order-now\" data-id=\"{$id}\" data-title=\"{$title}\" data-price=\"{$price}\" data-img=\"{$image_name}\">Order now</a>
                        <a href=\"{$url}\" class=\"add-to-order\" data-id=\"{$id}\" data-title=\"{$title}\" data-price=\"{$price}\" data-img=\"{$image_name}\">Add to Order</a>
                    </div>
                </div>
            </div>
        ";
    }

    function display_food($conn, $filter, $missing_message){
        try {

            $sql = "
                SELECT 
                    id, 
                    name, 
                    image_name,  
                    description,
                    price
                FROM 
                    foods
                WHERE {$filter};
            ";
    
            $res = mysqli_query($conn, $sql);
            if($res == true){
                $no_rows = mysqli_num_rows($res);
                if($no_rows > 0){
                    $SN = 1;
                    while($row=mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['name'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $description = $row['description'];
                        print_food_card($title,$image_name,$price,$description,$id);
                    }
                } else {
                    echo "<h2 style=\"color: #eee\">{$missing_message}</h2>";
                }
            }
        } catch (mysqli_sql_exception $e){
            echo "<h2 style=\"color: #eee\">{$missing_message}</h2>";
        }
    }                    
?>