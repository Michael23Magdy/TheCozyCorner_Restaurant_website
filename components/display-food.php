<?php
    function print_food_card($title, $image_name, $price, $description, $id){
        $order_now = SITE_URL."admin/delete-food.php?id={$id}&name=food";
        $add_to_order = SITE_URL."admin/update-food.php?id={$id}&name=food";
        if(empty($category_name)) $category_name = "no category selected";
        echo "
            <div class=\"food-card card\"
                style=\"background: url('images/food/{$image_name}')\">
                <h3>{$title}</h3>
                <div class=\"details\">
                    <p class=\"price\">$ {$price}</p>
                    <p class=\"des\">{$description}</p>
                    <div>
                        <a href=\"\">Order now</a>
                        <a href=\"\">Add to Order</a>
                    </div>
                </div>
            </div>
        ";
    }

    function display_food($conn, $filter, $missing_message){
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
                echo $missing_message;
            }
        }
    }                    
?>