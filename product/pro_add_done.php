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
            $pro_name     = $_POST['name'];
            $pro_price    = $_POST['price'];
            $pro_img_name = $_POST['img_name'];

            $pro_name  = htmlspecialchars($pro_name ,ENT_QUOTES,'UTF-8');
            $pro_price  = htmlspecialchars($pro_price ,ENT_QUOTES,'UTF-8');

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO mst_product(name,price,img) VALUES (?,?,?)";

            $stmt = $dbh -> prepare($sql);
            $data[] = $pro_name; //一番最初の?に入る
            $data[] = $pro_price; //二番目の?に入る
            $data[] = $pro_img_name;
            $stmt -> execute($data); //dataを?に入れる

            $dbh = null; //データベースから切断
            echo "{$pro_name}を追加しました";
        } catch (Exception $e) {
            echo 'ただいま障害によりご迷惑をおかけしています｡';
            exit();
        }
        //これには脆弱性が2つ含まれているらしい｡教科書のurlをみながら対処
        //他にも徳丸先生のアドバイスから脆弱性対策していこう!

    ?>
    <a href="pro_list.php">戻る</a>
</body>
</html>