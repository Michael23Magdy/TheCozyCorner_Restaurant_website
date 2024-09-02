<?php
    try {
        include('../config/constants.php');
        include('Components/login_check.php');
        if(isset($_GET['id']) && isset($_GET['newstat'])){
            $id = $_GET['id'];
            $newstat = $_GET['newstat'];

            $sql_check = "SELECT order_id FROM orders WHERE order_id={$id}";
            $res_check = mysqli_query($conn, $sql_check);
            if(mysqli_num_rows($res_check)!=1){
                $_SESSION['stat'] = "Order Not Found";
                $_SESSION['success'] = false;
                header('location:'.SITE_URL."admin/manage-orders.php?name=orders");
            };

            if($newstat=="Delete"){
                $sql2 = "DELETE FROM order_details WHERE order_id={$id}";
                $res2 = mysqli_query($conn,$sql2);
                $sql = "DELETE FROM orders WHERE order_id={$id}";
                $res = mysqli_query($conn,$sql);
                $_SESSION['stat'] = "Order Deleted Successfuly";
                $_SESSION['success'] = true;
                header('location:'.SITE_URL."admin/manage-orders.php?name=orders");
            } else {
                $sql = "UPDATE orders SET status = '{$newstat}' WHERE order_id={$id}";
                $res = mysqli_query($conn,$sql);
                $_SESSION['stat'] = "Status Chaged Successfuly";
                $_SESSION['success'] = true;
                header('location:'.SITE_URL."admin/manage-orders.php?name=orders");
            }
            
            


        } else {
            $_SESSION['stat'] = "Order Not Found";
            $_SESSION['success'] = false;
            header('location:'.SITE_URL."admin/manage-orders.php?name=orders");
        }
    } catch(mysqli_sql_exception $e){
        $_SESSION['stat'] = "failed to change status".$e;
        $_SESSION['success'] = false;
        header('location:'.SITE_URL."admin/manage-orders.php?name=orders");
    }
?>