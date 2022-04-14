<?php
    session_start();
    session_regenerate_id(true);

    require_once('../common/common.php');
    $post=sanitize($_POST);
    $max=$post['max'];
    $cart = $_SESSION['cart'];
    for ($i=0; $i <$max ; $i++) { $pro_count[]=$post["pro_count{$i}"];}
    for ($i=$max; 0<$i; $i--) {
        if (isset($_POST["delete{$i}"])==true) {
            array_splice($cart,$i,1);
            array_splice($pro_count,$i,1);
        }
    }
    $_SESSION['cart']=$cart;
    $_SESSION['pro_count']=$pro_count;
    header('Location:shop_cartlook.php');
    exit()
?>