<?php
    session_start();
    $_SESSION=array();
    if (isset($_COOKIE[session_name()])==true) {
        setcookie(session_name(),'',time()-42000,'/');
    }
    session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>ログアウトしました</p>
    <a href="../staff_login/staff_login.php">ログイン画面へ</a>
</body>
</html>