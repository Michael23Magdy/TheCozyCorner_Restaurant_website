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
            <form action="" method="POST" class="order-form" id="orderForm">
                <input required type="tel" name="phone-number" id="phone-number" placeholder="Enter your phone number">
                <input required type="text" name="address" id="address" placeholder="Enter Your Location">
                <p id="total-price"> total price: </p>
                <input type="button" value="Confirm Order" id="confirmOrderButton" onclick="confirmOrder()">
                <a href="" onclick="removeOrder()">Remove Order</a>
            </form>
        </div>
    </section>
    
    <?php include('components/search-section.php') ?>
    <?php include('components/footer.php') ?>
    <script>

        function confirmOrder() {
            // Retrieve the order data from localStorage
            const orderData = localStorage.getItem('order');
            let order = orderData ? JSON.parse(orderData) : null;

            // Collect form data
            const form = document.getElementById('orderForm');
            const formData = new FormData(form);
            const formObject = Object.fromEntries(formData.entries()); // Convert FormData to an object

            // Combine form data and order data
            const combinedData = {
                ...formObject,  // Spread form data
                order // Add order object if it exists
            };
            // alert(JSON.stringify(combinedData, null, 2));
            // Send combined data to the server
            fetch('process-order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(combinedData) // Convert combined data to JSON
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Success:', data);
            })
            .catch(error => {
                console.error('Error:', error);
            });

            localStorage.removeItem('order');

            
            setTimeout(()=>{window.location.href = 'purchase-details.php';},1000);

        }

    </script>
</body>
