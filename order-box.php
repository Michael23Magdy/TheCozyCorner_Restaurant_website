<?php include('config/constants.php') ?>
<?php
    if(!isset($_SESSION['username'])){
        header('location:'.SITE_URL.'login.php');
        die();
    }

?>
<?php include('components/meta-data.php') ?>

<body>
    <?php include('components/header.php') ?>

    <section class="featured">
        <div class="container">
            <h2>Your Order</h2>
            <div class="order-items" id="order-items">

            </div>

            <h2>Order details</h2>
            <form action="" method="POST" class="order-form">
                <input type="tel" name="phone-number" id="phone-number" placeholder="Enter your phone number">
                <input type="text" name="location" id="location" placeholder="Enter Your Location">
                <p id="total-price"> total price: </p>
                <input type="submit" value="Confirm Order" onclick="removeOrder()">
                <a href="" onclick="removeOrder('are you sure you want to delete the order?')">Remove Order</a>
                <!-- <input type="button" id="delete-order" value="Remove Order" > -->
            </form>
        </div>
    </section>

    <?php include('components/footer.php') ?>
</body>
