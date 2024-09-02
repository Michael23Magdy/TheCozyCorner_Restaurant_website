<?php include('components/sidebar_header.php') ?>

    <main>
        <h2><i class="fa-solid fa-motorcycle"></i> Manage Orders</h2>
        <br>
        <div class="database">
            <div class="filters">
                <a href="manage-orders.php?filter=Done&name=orders" class="btn-add general-btns">all</a>
                <a href="manage-orders.php?filter=Done&name=orders" class="btn-done general-btns">Done</a>
                <a href="manage-orders.php?filter=Pending&name=orders" class="btn-pending general-btns">Pending</a>
                <a href="manage-orders.php?filter=Cancel&name=orders" class="btn-cancel general-btns">Canceled</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>customer</th>
                        <th>total price</th>
                        <th>status</th>
                        <th>date</th>
                        <th>phone</th>
                        <th>address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $filter = isset($_GET['filter'])? "WHERE status = '{$_GET['filter']}'":"";
                        $sql = "
                            SELECT 
                                orders.order_id as order_id, 
                                users.username as username, 
                                orders.total_price as total_price,  
                                orders.status as status, 
                                orders.order_date as date,
                                orders.phone,
                                orders.address
                            FROM 
                                orders
                            LEFT JOIN 
                                users 
                            ON 
                                orders.user_id = users.user_id
                            {$filter}
                            ORDER BY order_id DESC;
                        ";
                        $res = mysqli_query($conn, $sql);

                        function print_category_row($SN, $username, $total_price, $status, $date, $phone,$address,$id){
                            $url_dit = SITE_URL."admin/order-details.php?id={$id}&name=orders";
                            $url_stat = SITE_URL."admin/status-control.php?id={$id}&newstat=";
                            echo "
                                <tr class=\"clickable-row\" data-href=\"{$url_dit}\">
                                    <td class=\"center_tbl_col\">{$SN}</td>
                                    <td>{$username}</td>
                                    <td class=\"center_tbl_col\">{$total_price}</td>
                                    <td class=\"center_tbl_col\">{$status}</td>
                                    <td>{$date}</td>
                                    <td>{$phone}</td>
                                    <td>{$address}</td>
                                    <td class=\"center_tbl_col status-control\" >
                                        <a href=\"{$url_stat}Done\" class=\"done\"><i class=\"fa-solid fa-check\"></i></a>
                                        <a href=\"{$url_stat}Pending\" class=\"pending\"><i class=\"fa-regular fa-clock\"></i></a>
                                        <a href=\"{$url_stat}Cancel\" class=\"cancel\"><i class=\"fa-solid fa-ban\"></i></a>
                                        <a href=\"{$url_stat}Delete\" class=\"delete\"><i class=\"fa-solid fa-delete-left \"></i></a>
                                    </td>
                                </tr>
                            ";
                        }
                        
                        if($res == true){
                            $no_rows = mysqli_num_rows($res);
                            if($no_rows > 0){
                                $SN = 1;
                                while($row=mysqli_fetch_assoc($res)){
                                    $id = $row['order_id'];
                                    $username = $row['username'];
                                    $total_price = $row['total_price'];
                                    $status = $row['status'];
                                    $date = $row['date'];
                                    $phone = $row['phone'];
                                    $address = $row['address'];
                                    print_category_row($SN++,$username,$total_price,$status,$date,$phone,$address,$id);
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
    <script>
        // Attach click event to each row with the class "clickable-row"
        document.querySelectorAll('.clickable-row').forEach(row => {
            row.addEventListener('click', () => {
                // Navigate to the URL specified in the data-href attribute
                window.location.href = row.dataset.href;
            });
        });
    </script>
                    
<?php include('components/footer.php') ?>