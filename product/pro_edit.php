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
            $pro_code = $_GET['procode'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = 'select * from mst_product where code=?';
            $stmt = $dbh ->prepare($sql);
            $data[] = $pro_code;
            $stmt -> execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $pro_name  = $rec['name'];
            $pro_price = $rec['price'];

            $dbh = null;
        } catch (Exception $e) {
            echo $e;
            echo 'ただいま障害によりご迷惑をおかけしています｡';
            exit();
        }

        echo <<<EOM
        <p>商品修正</p>
        <p>商品コード</p>
        <p>{$pro_code}</p>
        <form method="post" action="pro_edit_check.php">
            <input type="hidden" name="code" value="{$pro_code}">
            <p>商品名</p>
            <input type="text" name = "name" value = "{$pro_name}">
            <p>価格</p>
            <input type="number" name="price" min = "0" step="100">
            <br/>
            <input type="button" onclick="history.back()" value = "戻る">
            <input type="submit" value="ok">
        </form>
        EOM;
    ?>
</body>
</html>