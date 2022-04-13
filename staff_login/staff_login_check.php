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
            $staff_code = $_POST['code'];
            $staff_pass = $_POST['pass'];

            $staff_code = htmlspecialchars($staff_code,ENT_QUOTES,'UTF-8');
            $staff_pass = htmlspecialchars($staff_pass,ENT_QUOTES,'UTF-8');

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

            $rec = $stmt -> fetch(PDO::FETCH_ASSOC);

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