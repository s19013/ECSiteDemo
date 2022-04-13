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
        try {
            $staff_code = $_GET['staffcode'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = 'select * from mst_staff where code=?';
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
        <p>スタッフ修正</p>
        <p>スタッフコード</p>
        <p>{$staff_code}</p>
        <form method="post" action="staff_edit_check.php">
            <input type="hidden" name="code" value="{$staff_code}">
            <p>スタッフ名</p>
            <input type="text" name = "name" value = "{$staff_name}">
            <p>パスワードを入力してください</p>
            <input type="password" name = "pass">
            <p>パスワードを再度入力してください</p>
            <input type="password" name = "pass2"><br/>
            <input type="button" onclick="history.back()" value = "戻る">
            <input type="submit" value="ok">
        </form>
        EOM;
    ?>
</body>
</html>