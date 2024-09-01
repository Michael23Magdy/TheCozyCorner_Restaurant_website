<?php include('config/constants.php') ?>
<?php include('components/meta-data.php') ?>

<body>
    <?php include('components/header.php') ?>

    <section class="purchase-details featured">
        <div class="container">
            <h2>your recipt</h2>
            <div class="purchase">
                <?php 
                    $sql = "SELECT * FROM orders WHERE user_id = '{$_SESSION['user_id']}' 
                            ORDER BY order_id DESC LIMIT 1";
                    $res = mysqli_query($conn, $sql);
                    if($res){
                        $count = mysqli_num_rows($res);
                        if($count != 1){
                            echo "error";
                            // header('location:'.SITE_URL);
                            // die();
                        }
                    }
                    $order = mysqli_fetch_assoc($res);
                    $order_id = $order['order_id'];

                    $sql2 = "SELECT foods.name as name, order_details.quantity as quantity
                            FROM order_details 
                            left JOIN foods
                            on food_id = id
                            WHERE order_id = {$order_id}";
                    $res = mysqli_query($conn, $sql2);
                
                ?>
                <table>
                    <tr>
                        <td>your order id is</td>
                        <td><?php echo $order['order_id']?></td>
                    </tr>
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
                </table>
                <br>
                <h4>Meals purchased :</h4>
                <br>
                <ul>
                    <?php
                    while($item = mysqli_fetch_assoc($res)){
                        echo "<li> {$item['name']} x {$item['quantity']} </li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </section>

    <?php include('components/search-section.php') ?>
    <?php include('components/footer.php') ?>
</body>