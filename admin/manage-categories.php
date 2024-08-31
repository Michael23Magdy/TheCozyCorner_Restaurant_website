<?php include('components/sidebar_header.php') ?>
    <main>
        <h2><i class="fa-solid fa-basket-shopping"></i> Manage Categories</h2>
        <br>
        <div class="database">
            <a href="add-category.php?name=categories" class="btn-add"> <i class="fa-solid fa-plus"></i> Add Category</a>
            <table>
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>title</th>
                        <th>image</th>
                        <th>featured</th>
                        <th>active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM categories ORDER BY active DESC, Featured DESC";
                        $res = mysqli_query($conn, $sql);

                        function print_category_row($SN, $title, $image_name,$featured,$active,$id){
                            $url_del = SITE_URL."admin/delete-category.php?id={$id}&name=categories";
                            $url_upd = SITE_URL."admin/update-category.php?id={$id}&name=categories";
                            $featured = $featured? "YES" : "NO";
                            $active = $active? "YES" : "NO";
                            echo "
                            <tr>
                            <td class=\"center_tbl_col\">{$SN}</td>
                            <td>{$title}</td>
                            ";
                            if(empty($image_name))
                                echo "<td class=\"center_tbl_col\">no image</td>";
                            else
                                echo "<td class=\"center_tbl_col\"><img src=\"../images/categories/{$image_name}\" alt=\"\" style=\"width: 50px\"></td>";
                            echo "
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
                                    $title = $row['title'];
                                    $image_name = $row['image_name'];
                                    $featured = $row['featured'];
                                    $active = $row['active'];
                                    print_category_row($SN++,$title,$image_name,$featured,$active,$id);
                                }
                            } else {
                                echo "
                                    <tr> <td colspan=\"6\" class=\"center_tbl_col\" style=\"color: #aaa;\"> no data added </td> <tr> 
                                ";
                            }
                        }
                        ?>
                </tbody>
            </table>
        </div>
    </main>

<?php include('components/footer.php') ?>