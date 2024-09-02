<?php include('components/sidebar_header.php') ?>
<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql_check = "SELECT * FROM orders WHERE order_id='{$id}'";
        $res_check = mysqli_query($conn, $sql_check);
        if($res_check){
            if(mysqli_num_rows($res_check)!=1){
                $_SERVER['stat'] = "Category not found";
                $_SERVER['success'] = false;
                header(SITE_URL."admin/manage-categories.php?name=categories");
            }
        } else {
            $_SERVER['stat'] = "Error";
            $_SERVER['success'] = false;
            header(SITE_URL."admin/manage-categories.php?name=categories");
        }
        $order = mysqli_fetch_assoc($res_check);
        $sql2 = "SELECT foods.name as name, order_details.quantity as quantity, order_details.price as price
                FROM order_details 
                left JOIN foods
                on food_id = id
                WHERE order_id = {$id}";
        $res2 = mysqli_query($conn, $sql2);
    } else {
        $_SERVER['stat'] = "Category not found";
        $_SERVER['success'] = false;
        header(SITE_URL."admin/manage-categories.php?name=categories");
    }
?>
    <main>
        <h2><i class="fa-solid fa-basket-shopping"></i> Order Number <?php echo $id?></h2>
        <div class="order-container">
        <table>
            <tr>
                <td>date: </td>
                <td><?php echo $order['order_date']?></td>
            </tr>
            <tr>
                <td>address: </td>
                <td><?php echo $order['address']?></td>
            </tr>
            <tr>
                <td>cost:</td>
                <td>$<?php echo $order['total_price']?></td>
            </tr>
            <tr>
                <td>status:</td>
                <td><?php echo $order['status']?></td>
            </tr>
        </table>
        <br>
        <h4>Meals purchased :</h4>
        <br>
        <ul>
            <?php
            while($item = mysqli_fetch_assoc($res2)){
                echo "<li> {$item['name']} x {$item['quantity']} </li>";
            }
            ?>
        </ul>
        </div>
    </main>
<?php include('Components/footer.php') ?>