<?php include('components/sidebar_header.php') ?>
    <main>
        <h2><i class="fa-solid fa-bowl-food"></i> Manage Food</h2>
        <br>
        <div class="database">
            <a href="add-food.php?name=food" class="btn-add general-btns"> <i class="fa-solid fa-plus"></i> Add Food</a>
            <table>
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>food</th>
                        <th>price</th>
                        <th>image</th>
                        <th>category</th>
                        <th>featured</th>
                        <th>active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "
                            SELECT 
                                foods.id, 
                                foods.name as food_name, 
                                foods.image_name,  
                                foods.price, 
                                foods.featured,
                                foods.active,
                                categories.title
                            FROM 
                                foods
                            LEFT JOIN 
                                categories 
                            ON 
                                foods.category_id = categories.id
                            ORDER BY active DESC, featured DESC;
                        ";
                        $res = mysqli_query($conn, $sql);

                        function print_category_row($SN, $title, $image_name, $price, $category_name, $featured,$active,$id){
                            $url_del = SITE_URL."admin/delete-food.php?id={$id}&name=food";
                            $url_upd = SITE_URL."admin/update-food.php?id={$id}&name=food";
                            $featured = $featured? "YES" : "NO";
                            $active = $active? "YES" : "NO";
                            if(empty($category_name)) $category_name = "no category selected";
                            echo "
                            <tr>
                            <td class=\"center_tbl_col\">{$SN}</td>
                            <td>{$title}</td>
                            <td class=\"center_tbl_col\">\$ {$price}</td>
                            ";
                            if(empty($image_name))
                                echo "<td class=\"center_tbl_col\">no image</td>";
                            else
                                echo "<td class=\"center_tbl_col\"><img src=\"../images/food/{$image_name}\" alt=\"\" style=\"width: 50px\"></td>";
                            echo "
                                    <td class=\"center_tbl_col\">{$category_name}</td>
                                    <td class=\"center_tbl_col\">{$featured}</td>
                                    <td class=\"center_tbl_col\">{$active}</td>
                                    <td class=\"center_tbl_col\">
                                        <a href=\"{$url_upd}\"><i class=\"fa-solid fa-pen\"></i></a>
                                        <a href=\"{$url_del}\"><i class=\"fa-solid fa-delete-left \"></i></a>
                                    </td>
                                </tr>
                            ";
                        }
                        
                        if($res == true){
                            $no_rows = mysqli_num_rows($res);
                            if($no_rows > 0){
                                $SN = 1;
                                while($row=mysqli_fetch_assoc($res)){
                                    $id = $row['id'];
                                    $title = $row['food_name'];
                                    $price = $row['price'];
                                    $category_name = $row['title'];
                                    $image_name = $row['image_name'];
                                    $featured = $row['featured'];
                                    $active = $row['active'];
                                    print_category_row($SN++,$title,$image_name,$price,$category_name,$featured,$active,$id);
                                }
                            } else {
                                echo "
                                    <tr> <td colspan=\"8\" class=\"center_tbl_col\" style=\"color: #aaa;\"> no data added </td> <tr> 
                                ";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

<?php include('components/footer.php') ?>