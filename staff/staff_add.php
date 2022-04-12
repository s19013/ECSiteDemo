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
        <p>スタッフ追加</p>
        <form method="post", action="staff_add_check.php">
            <p>スタッフ名を入力してください</p>
            <input type="text" name="name">
            <p>パスワードを追加してください</p>
            <input type="password" name="pass">
            <p>もう一度パスワードを入力してください</p>
            <input type="password" name="pass2"><br>
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value = "ok">
        </form>
        <?php
        // put your code here
        ?>
    </body>
</html>
