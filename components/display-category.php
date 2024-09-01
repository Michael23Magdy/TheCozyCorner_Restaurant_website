<?php
    function print_category_card($title, $image_name, $description, $id){
        $category_url = SITE_URL."admin/delete-food.php?id={$id}&name=food";
        echo "
            <div class=\"category-card card\"
                style=\"background: url('images/categories/{$image_name}')\">
                <h3>{$title}</h3>
                <a href=\"{$category_url}\">
                    <div class=\"details\">
                        <p class=\"des\">{$description}</p>
                    </div>
                </a>
            </div>
        ";
    }

    function display_category($conn, $filter, $missing_message){
        $sql = "
            SELECT 
                id, 
                title, 
                image_name,  
                description
            FROM 
                categories
            WHERE {$filter};
        ";

        $res = mysqli_query($conn, $sql);
        if($res == true){
            $no_rows = mysqli_num_rows($res);
            if($no_rows > 0){
                $SN = 1;
                while($row=mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    print_category_card($title,$image_name,$description,$id);
                }
            } else {
                echo $missing_message;
            }
        }
    }                    
?>