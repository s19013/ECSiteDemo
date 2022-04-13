<?php
    require_once('../common/common.php');
?>
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
            $post = sanitize($_POST);
            $staff_code  = $post['code'];
            $staff_name  = $post['name'];
            $staff_pass  = $post['pass'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE `mst_staff` SET `name`=?,`password`=? WHERE code=?";
            $stmt = $dbh -> prepare($sql);
            $data[] = $staff_name;
            $data[] = $staff_pass;
            $data[] = $staff_code;
            $stmt -> execute($data);

            $dbh = null; //データベースから切断
        } catch (Exception $e) {
            echo 'ただいま障害によりご迷惑をおかけしています｡';
            exit();
        }

        
    ?>
    <p>修正しました</p>
    <a href="staff_list.php">戻る</a>
</body>
</html>