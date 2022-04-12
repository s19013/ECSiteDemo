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
        try {
            $pro_code  = $_POST['code'];
            $pro_name  = $_POST['name'];
            $pro_price = $_POST['price'];
            $pro_img_name_old= $_POST['img_name_old'];
            $pro_img_name = $_POST['img_name'];

            $pro_code  = htmlspecialchars($pro_code  ,ENT_QUOTES,'UTF-8');
            $pro_name  = htmlspecialchars($pro_name ,ENT_QUOTES,'UTF-8');
            $pro_price = htmlspecialchars($pro_price ,ENT_QUOTES,'UTF-8');

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE mst_product SET name=?,price=?,img=? WHERE code = ?";
            $stmt = $dbh -> prepare($sql);
            $data[] = $pro_name; //一番最初の?に入る
            $data[] = $pro_price; //二番目の?に入る
            $data[] = $pro_img_name;
            $data[] = $pro_code;
            $stmt -> execute($data); //dataを?に入れる

            $dbh = null; //データベースから切断


            if ($pro_img_name_old !='') {unlink("../img/yasai/{$pro_img_name_old}");}

            echo "修正しました";
        } catch (Exception $e) {
            echo $e;
            echo 'ただいま障害によりご迷惑をおかけしています｡';
            exit();
        }
        //これには脆弱性が2つ含まれているらしい｡教科書のurlをみながら対処
        //他にも徳丸先生のアドバイスから脆弱性対策していこう!

    ?>
    <a href="pro_list.php">戻る</a>
</body>
</html>