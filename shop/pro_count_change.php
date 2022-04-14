<?php
    session_start();
    session_regenerate_id(true);

    require_once('../common/common.php');
    $post=sanitize($_POST);
    
    $max=$post['max'];
    for ($i=0; $i <$max ; $i++) { $pro_count[]=$post['pro_count'.$i];}
    $_SESSION['pro_count']=$pro_count;
    header('Location:shop_cartlook.php');
    exit()
?>