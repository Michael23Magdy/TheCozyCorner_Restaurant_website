<?php
    if(isset($_SESSION['username'])){
        if($_SESSION['role']!="admin"){
            header('location:'.SITE_URL);
        }
    } else {
        header('location:'.SITE_URL.'login.php');
    }
?>