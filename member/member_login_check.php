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
            $member_email = $post['email'];
            $member_pass  = $post['pass'];

            $member_pass = md5($member_pass);

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT code,name FROM dat_member WHERE email=? AND password=?";
            $stmt   = $dbh -> prepare($sql);
            $data[] = $member_email;
            $data[] = $member_pass;
            $stmt -> execute($data);

            $dbh = null; //データベースから切断

            $rec = $stmt -> fetch(PDO::FETCH_ASSOC);

            if ($rec==false) {
                echo "<p>メールアドレスかパスワードが間違えています</p>";
                echo '<a href="member_login.php">戻る</a>';
            } else {
                session_start();
                $_SESSION['member_login']=1;
                $_SESSION['member_code'] = $rec['code'];
                $_SESSION['member_name'] = $rec['name'];
                header('Location:../shop/shop_list.php');
                exit();
            }
        } catch (Exception $e) {
            echo "$e";
            echo 'ただいま障害によりご迷惑をおかけしています｡';
            exit();
        }
    ?>
</body>
</html>