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
            $staff_name  = $post['name'];
            $staff_pass  = $post['pass'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO `mst_staff`(`name`, `password`) VALUES (?,?)";
            $stmt = $dbh -> prepare($sql);
            $data[] = $staff_name; //一番最初の?に入る
            $data[] = $staff_pass; //二番目の?に入る
            $stmt -> execute($data); //dataを?に入れる

            $dbh = null; //データベースから切断
            echo "{$staff_name}さんを追加しました";
        } catch (Exception $e) {
            echo 'ただいま障害によりご迷惑をおかけしています｡';
            exit();
        }

        
    ?>
    <a href="staff_list.php">戻る</a>
</body>
</html>