<?php
    require_once("../common/common.php");
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
    <h2>お客様の情報を入力してください</h2>
    <form method="post" action="shop_form_check.php">
        <p>お名前</p>
        <input type="text" name="name" required><br>
        <p>メールアドレス</p>
        <input type="text" name="email" required><br>
        <p>郵便番号</p>
        <input type="number" name="postal1" max="999" > - <input type="number" name="postal2" max="9999" required><br>
        <p>住所</p>
        <input type="text" name="address" required><br>
        <p>電話番号</p>
        <input type="number" name="tel" max="9999999999999" required><br>

        <p>※会員登録する方は以下の項目も入力してください</p>
        <input type="radio" name="order" value="order_only_this_time" checked>今回だけの注文
        <input type="radio" name="order" value="order_join_member">会員登録しての注文<br>
        <p>登録するパスワードを入力してください</p>
        <input type="password" name="pass" id=""><br>
        <p>確認のためにパスワードをもう一度入力してください</p>
        <input type="password" name="pass2" id=""><br>
        <p>性別</p>
        <input type="radio" name="gender" value="male" checked>男
        <input type="radio" name="gender" value="female">女<br>

        <p>生まれ年</p>
        <select name="birth" id="">
            <?php pulldown_year_shop_from(); ?>
        </select>
        <br>

        <input type="button" value="戻る" onclick="history.back()">
        <input type="submit" value="次へ">
    </form>
</body>
</html>