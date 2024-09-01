<?php
    include('config/constants.php');

    header('Content-Type: application/json');
    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Function to sanitize input
    function sanitize_input($data) {
        return htmlspecialchars(trim($data));
    }

    // Read the JSON data from the request
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    
    // Check if the data includes the form fields and order details
    if (isset($data['phone-number'], $data['address'], $data['order'])) {
        // Extract form data
        $phone_number = $data['phone-number'];
        $address = $data['address'];

        $sql = "INSERT INTO orders (user_id, order_date,status , phone, address)
                values ({$_SESSION['user_id']}, now(),'Ordered', '{$phone_number}', '{$address}')";
        $res = mysqli_query($conn, $sql);

        if($res){
            $last_id = mysqli_insert_id($conn);
            foreach ($data['order']['items'] as $item) {
                $id = $item['id'];
                $name = $item['name'];
                $quantity = $item['quantity'];
                $price = $item['price'] * $quantity;

                $sql2 = "INSERT INTO order_details (order_id, food_id, quantity, price)
                        VALUES ({$last_id}, {$id}, {$quantity}, {$price})";
                $res2 = mysqli_query($conn, $sql2);
            }
        }
    
        // Return success response
        echo json_encode(['status' => 'success', 'message' => 'Order processed successfully']);
    } else {
        // Return error response
        echo json_encode(['status' => 'error', 'message' => 'Invalid order data']);
    }
    ?>