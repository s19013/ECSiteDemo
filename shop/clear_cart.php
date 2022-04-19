<?php
    function clear_cart()
    {
        session_start();
        $_SESSION=array();
        if (isset($_COOKIE[session_name()])==true) {
            setcookie(session_name(),'',time()-42000,'/');
        }
        session_destroy();
    }
    if (isset($_GET['name'])) {
        clear_cart();
        header("Location:shop_cartlook.php");
        exit();
    }
?>