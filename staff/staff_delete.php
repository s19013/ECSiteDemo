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
            $staff_code = $_GET['staffcode'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = 'select name from mst_staff where code=?';
            $stmt = $dbh ->prepare($sql);
            $data[] = $staff_code;
            $stmt -> execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $staff_name = $rec['name'];

            $dbh = null;
        } catch (Exception $e) {
            echo 'ただいま障害によりご迷惑をおかけしています｡';
            exit();
        }

        echo <<<EOM
        <p>スタッフ削除</p>
        <p>スタッフコード</p>
        <p>{$staff_code}</p>
        <p>スタッフ名</p>
        <p>{$staff_name}</p>
        <form method="post" action="staff_delete_done.php">
            <input type="hidden" name="code" value="{$staff_code}" >
            <input type="button" onclick="history.back()" value = "戻る">
            <input type="submit" value="ok">
        </form>
        EOM;
        
    ?>
</body>
</html>