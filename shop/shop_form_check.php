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
        require_once('../common/common.php');

        $post=sanitize($_POST);

        $okFlag = true;

        $name =$post['name'];
        $email=$post['email'];
        $postal1 = $post['postal1'];
        $postal2 = $post['postal2'];
        $address = $post['address'];
        $tel =$post['tel'];
        // メール確認
        if (preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',$email)==0) {
            echo"<p>メールを正確に入力してください</p>";
            $okFlag=false;
        }
        if ($okFlag=true) {
            echo <<<EOM
            <p>お名前:{$name}</p>
            <p>メールアドレス:{$email}</p>
            <p>郵便番号:{$postal1}-{$postal2}</p>
            <p>住所:{$address}</p>
            <p>電話番号:{$tel}</p>
            EOM;
            echo <<<EOM
            <form action="shop_form_done.php" method="post">
            <input type="hidden" name="name"    value=$name>
            <input type="hidden" name="email"   value=$email>
            <input type="hidden" name="postal1" value=$postal1>
            <input type="hidden" name="postal2" value=$postal2>
            <input type="hidden" name="address" value=$address>
            <input type="hidden" name="tel"     value=$tel>
            <input type="button" value="戻る" onclick="history.back()">
            <input type="submit" value="次へ">
            </form>
            EOM;
        }
    ?>
    
</body>
</html>