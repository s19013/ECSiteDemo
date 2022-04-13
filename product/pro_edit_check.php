<?php
    session_start();
    session_regenerate_id(true); //あとでここの1文を抜いたphp文をstaff,productにすべて貼り付ける
    if (isset($_SESSION['login'])==false) {
        echo "ログインされてない <br>";
        echo "<a href=../staff_login/staff_login.php>ログイン画面へ</a>";
        exit();
    } else {
        echo "{$_SESSION['staff_name']}さんログイン中 <br>";
    }
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $pro_code  = $_POST['code'];
        $pro_name  = $_POST['name'];
        $pro_price = $_POST['price'];
        $pro_img_name_old= $_POST['img_name_old'];
        $pro_img = $_FILES['img'];

        //フラグ
        $pro_name_ok  = false;
        $pro_price_ok = false;
        $pro_img_ok   = false;

        $pro_code   = htmlspecialchars($pro_code  ,ENT_QUOTES,'UTF-8');
        $pro_name   = htmlspecialchars($pro_name  ,ENT_QUOTES,'UTF-8');
        $pro_price  = htmlspecialchars($pro_price ,ENT_QUOTES,'UTF-8');

        if ($pro_name == '') { //pro_nameになにもなかった場合
            echo '<p>商品名が入力されていません</p>';
        } else {
            $pro_name_ok = true;
            echo "<p>商品名:{$pro_name}</p>";
        }

        if (preg_match('/\A[0-9]+\z/',$pro_price)==0) { //pro_priceになにもなかった場合
            echo '<p>価格を入力してください</p>';
        } else {
            $pro_price_ok = true;
            echo "<p>価格:{$pro_price}円</p>";
        }

        if ($pro_img['size']>0) {
            if ($pro_img['size'] > 10000000) { echo '画像が大きすぎます'; }
            else {
                move_uploaded_file($pro_img['tmp_name'],"../img/yasai/{$pro_img['name']}"); //これでサーバーに画像をアップロードするらしい
                echo <<< EOM
                <img src='../img/yasai/{$pro_img['name']}'> <br/>
                EOM;
                $pro_img_ok = true;
            }
        }

        if($pro_name_ok == true && $pro_price_ok == true && $pro_img_ok == true){
            echo <<< EOM
            <form method = "post" action="pro_edit_done.php">
                <input type="hidden" name = "code"  value = "{$pro_code}">
                <input type="hidden" name = "name"  value = "{$pro_name}">
                <input type="hidden" name = "price" value = "{$pro_price}">
                <input type="hidden" name = "img_name_old" value = "{$pro_img_name_old}">
                <input type="hidden" name = "img_name" value = "{$pro_img['name']}">
                <p>上記のように変更します</p>
                <input type="button" onclick = "history.back()" value = "戻る">
                <input type="submit" value="ok">
            </form>
            EOM;
        } else {
            echo <<< EOM
                <form action="">
                    <input type="button" onclick = "history.back()" value = "戻る">
                </form>
            EOM;
        }
    ?>
</body>
</html>