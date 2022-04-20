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
            $year =$_POST['year'];
            $month=$_POST['month'];
            $day  =$_POST['day'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = "
            SELECT
	        ds.code,
            ds.date,
            ds.code__member,
            ds.name AS 'dat_sales_name',
            ds.email,
            ds.postal1,
            ds.postal2,
            ds.address,
            ds.tel,
            dsp.code_product,
            mp.name AS 'mst_product_name',
            dsp.price,
            dsp.quantity
            FROM mst_product AS mp
            JOIN dat_sales_product AS dsp
            ON mp.code = dsp.code_product
            JOIN dat_sales AS ds
            ON ds.code = dsp.code_sales
            WHERE
	        substr(ds.date,1,4)={$year}
            AND substr(ds.date,6,2)={$month}
            AND substr(ds.date,9,2)={$day}
            ";
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute();

            $dbh = null;

            //csvを作る
            $csv = "注文コード,注文日時,会員番号,名前,メール,郵便番号,住所,電話番号,商品コード,価格,数量\n";
            while (true) {
                $rec=$stmt->fetch(PDO::FETCH_ASSOC);
                if ($rec==false) {break;}
                $csv.= <<<EOM
                {$rec['code']},{$rec['date']},{$rec['code__member']},{$rec['dat_sales_name']},{$rec['email']},{$rec['postal1']}-{$rec['postal2']},{$rec['address']},{$rec['tel']},{$rec['code_product']},{$rec['mst_product_name']},{$rec['price']},{$rec['quantity']}\n
                EOM;
            }
            $file=fopen("./order-{$year}-{$month}-{$day}.csv",'w');
            // $csv =mb_convert_encoding($csv,'SJIS','UTF-8');
            fputs($file,$csv);
            fclose($file);
        } catch (Exception $e) {
            echo $e;
            echo 'ただいま障害によりご迷惑をおかけしています｡';
            exit();
        }
            
    ?>
    <a href="order.csv">ダウンロード</a><br>
    <a href="order_download.php">日付選択へ</a><br>
    <a href="../staff_login/staff_top.php">トップメニューへ</a><br>
</body>
</html>