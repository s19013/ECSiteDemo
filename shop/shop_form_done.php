<?php
    session_start();
    session_regenerate_id(true);
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
            require_once('../common/common.php');

            $post=sanitize($_POST);

            $name =$post['name'];
            $email=$post['email'];
            $postal1 = $post['postal1'];
            $postal2 = $post['postal2'];
            $address = $post['address'];
            $tel =$post['tel'];

            $cart=$_SESSION['cart'];
            $pro_count=$_SESSION['pro_count'];
            $max=count($cart);

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            echo<<<EOM
            <p>{$name}様</p>
            <p>ご注文ありがとうございました</p>
            <p>{$email}にメールを送りましたのでご確認ください</p>
            <p>商品は以下の住所に発送します</p>
            <p>{$postal1}-{$postal2}</p>
            <p>{$address}</p>
            EOM;

            //顧客用メールの本文作成
            $honbun =" " ;//初期化
            $honbun = <<<EOT
            {$name}様\n
            ご注文ありがとうございました\n
            \n
            ご注文の商品\n
            -----------------------------\n
            EOT;

            for ($i=0; $i <$max ; $i++) { 
                $sql = "SELECT * FROM mst_product WHERE code=?";
                $stmt = $dbh->prepare($sql);
                $data[0]=$cart[$i];
                $stmt -> execute($data);

                $rec = $stmt-> fetch(PDO::FETCH_ASSOC);

                $shoukei = $rec['price']*$pro_count[$i];

                $honbun .= <<<EOT
                | {$rec['name']} | {$rec['price']}円 | {$pro_count[$i]}個 | {$shoukei}円 |\n
                EOT;
            }
            $dbh = null;

            $honbun .= <<<EOT
            -----------------------------\n
            代金は以下の口座にお振込みください\n
            ろくまる銀行 やさい支店 普通口座 1234567\n
            入金確認が取れ次第､発送いたします\n
            \n
            ろくまる農園\n
            OO県XX市123-4\n
            電話:0120-333-906\n
            メール:info@rokumaru.co.jp\n
            EOT;

            // print nl2br($honbun);

            $title = "ご注文ありがとうございます";
            $header = 'From:info@rokumarunouen.co.jp';
            $honbun = html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
            mb_language('Japanese');
            mb_internal_encoding('UTF-8');
            mb_send_mail($email,$title,$honbun,$header);

        //店用のメール作成
            $title = "客から注文";
            $header = "From:{$email}";
            $honbun = html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
            mb_language('Japanese');
            mb_internal_encoding('UTF-8');
            mb_send_mail("info@rokumarunouen.co.jp",$title,$honbun,$header);
        } catch (Exception $e) {
            echo 'ただいま障害によりご迷惑をおかけしています｡';
            exit();
            
        }
    ?>
</body>
</html>