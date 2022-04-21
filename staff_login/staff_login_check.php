<?php
    require_once('../common/common.php');
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
            $staff_code = $post['code'];
            $staff_pass = $post['pass'];

            $staff_pass = md5($staff_pass);

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM mst_staff WHERE code=? AND password=?";
            $stmt = $dbh -> prepare($sql);
            $data[] = $staff_code; //一番最初の?に入る
            $data[] = $staff_pass; //二番目の?に入る
            $stmt -> execute($data); //dataを?に入れる

            $dbh = null; //データベースから切断

            $rec = $stmt -> fetch(PDO::FETCH_ASSOC);//取ってきたデータを連想配列でrecに保存

            if ($rec==false) {
                echo "<p>スタッフコードかパスワードが間違えています</p>";
                echo '<a href="staff_login.php"></a>';
            } else {
                session_start();
                $_SESSION['login']=1;
                $_SESSION['staff_code']=$staff_code;
                $_SESSION['staff_name']=$rec['name'];
                header('Location:staff_top.php');
                exit();
            }
        } catch (Exception $e) {
            echo 'ただいま障害によりご迷惑をおかけしています｡';
            exit();
        }
    ?>
</body>
</html>