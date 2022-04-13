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
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p>商品追加</p>
        <form method="post", action="pro_add_check.php" enctype="multipart/form-data">
            <p>商品名を入力してください</p>
            <input type="text" name="name">
            <p>価格を入力してください</p>
            <input type="number" name="price" min = "0" step="1">
            <p>画像を選んでください</p>
            <input type="file" name="img">
            <br>
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value = "ok">
        </form>
        <?php
        // put your code here
        ?>
    </body>
</html>
