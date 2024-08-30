<?php
    try {
        include('../config/constants.php');
        include('Components/login_check.php');
        $id = $_GET['id'];
        $sql_check = "SELECT image_name FROM categories WHERE id={$id}";
        $res_check = mysqli_query($conn, $sql_check);
        if(mysqli_num_rows($res_check)!=1){
            $_SESSION['stat'] = "Category not found";
            $_SESSION['success'] = false;
            header('location:'.SITE_URL."/admin/manage-categories.php?name=categories");
        };
        $category = mysqli_fetch_assoc($res_check);
        $image_name = $category['image_name'];
        if(!empty($image_name)){
            $remove = unlink("../images/categories/".$image_name);
            if(!$remove){
                $_SESSION['stat'] = "Couldn't delete image";
                $_SESSION['success'] = false;
                header('location:'.SITE_URL."/admin/manage-categories.php?name=categories");
            }
        }
        $sql_del = "DELETE FROM categories WHERE id={$id}";
        $res_del = mysqli_query($conn, $sql_del);
        if($res_del){
            $_SESSION['stat'] = "Category deleted successfully";
            $_SESSION['success'] = true;
            header('location:'.SITE_URL."/admin/manage-categories.php?name=categories");
        } else {
            $_SESSION['stat'] = "failed to delete category";
            $_SESSION['success'] = false;
            header('location:'.SITE_URL."/admin/manage-categories.php?name=categories");
        }
    } catch(mysqli_sql_exception $e){
        $_SESSION['stat'] = "failed to delete category";
        $_SESSION['success'] = false;
        header('location:'.SITE_URL."/admin/manage-categories.php?name=categories");
    }
?>