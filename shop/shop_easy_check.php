<?php
    session_start();
    session_regenerate_id(true);
    if (isset($_SESSION['member_login'])==false) {
        echo "<p>ログインされていません</p>";
        echo "<a href='shop_list.php'>商品一覧へ</a>";
        exit();
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
        require_once('../common/common.php');

        // $post=sanitize($_POST);
        $okFlag = true;

        $code = $_SESSION['member_code'];

        $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
        $user = 'root';
        $password = '';
        $dbh = new PDO($dsn,$user,$password);
        $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select name,email,postal1,postal2,address,tel from dat_member where code={$code}";
        $stmt = $dbh->prepare($sql);
        $stmt -> execute();
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        $dbh = null;

        $name =$rec['name'];
        $email=$rec['email'];
        $postal1 = $rec['postal1'];
        $postal2 = $rec['postal2'];
        $address = $rec['address'];
        $tel =$rec['tel'];

        //個人情報
        if ($okFlag=true) {
            echo <<<EOM
            <p>お名前:{$name}</p>
            <p>メールアドレス:{$email}</p>
            <p>郵便番号:{$postal1}-{$postal2}</p>
            <p>住所:{$address}</p>
            <p>電話番号:{$tel}</p>
            EOM;
            echo <<<EOM
            <form action="shop_easy_done.php" method="post">
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