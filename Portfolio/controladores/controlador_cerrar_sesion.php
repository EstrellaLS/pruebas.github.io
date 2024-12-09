<?php
    session_start();

    if (isset($_COOKIE["cookiUser"])){          
        setcookie("cookiUser", "", time()-10, "/");
    }
    
    if (isset($_SESSION["sesiUser"])){        
        session_destroy();
    }

    header("location:../index.php");
?>