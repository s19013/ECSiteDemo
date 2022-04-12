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
        <form method="post", action="pro_add_check.php">
            <p>商品名を入力してください</p>
            <input type="text" name="name">
            <p>価格を入力してください</p>
            <input type="number" name="price" min = "0" step="100">
            <br>
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value = "ok">
        </form>
        <?php
        // put your code here
        ?>
    </body>
</html>
