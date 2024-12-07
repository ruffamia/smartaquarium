<?php
    // Start the session
    session_start();

    if(isset($_SESSION["is_login"])&& $_SESSION["is_login"] == True ){
        header("Location: admin/index.php");
    } 
    else {
        header("Location: login.php");
    }
?>