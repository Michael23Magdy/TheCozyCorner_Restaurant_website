<?php
    try {
        include('../config/constants.php');
        include('Components/login_check.php');
        $id = $_GET['id'];
        $sql_check = "SELECT image_name FROM foods WHERE id={$id}";
        $res_check = mysqli_query($conn, $sql_check);
        if(mysqli_num_rows($res_check)!=1){
            $_SESSION['stat'] = "food not found";
            $_SESSION['success'] = false;
            header('location:'.SITE_URL."/admin/manage-food.php?name=foods");
        };
        $category = mysqli_fetch_assoc($res_check);
        $image_name = $category['image_name'];
        if(!empty($image_name)){
            $remove = unlink("../images/food/".$image_name);
            if(!$remove){
                $_SESSION['stat'] = "Couldn't delete image";
                $_SESSION['success'] = false;
                header('location:'.SITE_URL."/admin/manage-food.php?name=foods");
            }
        }
        $sql_del = "DELETE FROM foods WHERE id={$id}";
        $res_del = mysqli_query($conn, $sql_del);
        if($res_del){
            $_SESSION['stat'] = "food deleted successfully";
            $_SESSION['success'] = true;
            header('location:'.SITE_URL."/admin/manage-food.php?name=foods");
        } else {
            $_SESSION['stat'] = "failed to delete food";
            $_SESSION['success'] = false;
            header('location:'.SITE_URL."/admin/manage-food.php?name=foods");
        }
    } catch(mysqli_sql_exception $e){
        $_SESSION['stat'] = "failed to delete food";
        $_SESSION['success'] = false;
        header('location:'.SITE_URL."/admin/manage-food.php?name=foods");
    }
?>