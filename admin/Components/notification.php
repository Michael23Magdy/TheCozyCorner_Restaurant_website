<?php 
    if(isset($_SESSION['stat'])){
        $color = "fail";
        if($_SESSION['success']) $color = "success";
        echo "<p class=\"{$color} msg\"> <i class=\"fa-solid fa-bell\"></i> {$_SESSION['stat']} </p>";
        unset($_SESSION['stat']);
        unset($_SESSION['success']);
    }
?>