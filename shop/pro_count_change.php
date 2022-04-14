
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    session_start();
    session_regenerate_id(true);

    require_once('../common/common.php');

    $post=sanitize($_POST);
    $max = $post['max'];
    $cart= $_SESSION['cart'];

    //個数変更
    for ($i=0; $i <$max ; $i++)
    {
        if (preg_match("/\A[0-9]+\z/",$post["pro_count{$i}"])==0)
        {
            echo "<p>数値に誤りがあります</p>";
            echo "<a href='shop_cartlook.php'>カートに戻る</a>";
            exit();
        }
        $pro_count[]=$post["pro_count{$i}"];
    }

    //削除処理
    for ($i=$max; 0<=$i; $i--) {
        if (isset($_POST["delete{$i}"])==true) {
            array_splice($cart,$i,1);
            array_splice($pro_count,$i,1);
        }
    }

    //新しくセッションに保存
    $_SESSION['cart']=$cart;
    $_SESSION['pro_count']=$pro_count;
    header('Location:shop_cartlook.php');
    exit();
?>
</body>
</html>