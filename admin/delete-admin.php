
<?php
    try{
        include('../config/constants.php');
        $id = $_GET['id'];
        $sql = "DELETE FROM users WHERE user_id = {$id}";
        $res = mysqli_query($conn,$sql);
        if($res == true){
            if(mysqli_affected_rows($conn)>0){
                $_SESSION['stat'] = "Admin deleted Successfully";
                $_SESSION['success'] = true;
            } else {
                $_SESSION['stat'] = "Admin not found";
                $_SESSION['success'] = false;
            }
        }
        header('location:'.SITE_URL."/admin/manage-admins.php");
    } catch (mysqli_sql_exception $e){
        $_SESSION['stat'] = "failed to delete admin";
        $_SESSION['success'] = false;
        header('location:'.SITE_URL."/admin/manage-admins.php");
    }
?>