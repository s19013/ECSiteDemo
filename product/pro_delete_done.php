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
            $pro_img_name = $_POST['img_name'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM `mst_product` WHERE code=?";
            $stmt = $dbh -> prepare($sql);
            $data[] = $pro_code;
            $stmt -> execute($data);

            $dbh = null; //データベースから切断

            if ($pro_img_name != '') {unlink("../img/yasai/{$pro_img_name}");}
        } catch (Exception $e) {
            echo 'ただいま障害によりご迷惑をおかけしています｡';
            exit();
        }

    ?>
    <p>削除しました</p>
    <a href="pro_list.php">戻る</a>
</body>
</html>