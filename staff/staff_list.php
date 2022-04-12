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
            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = 'SELECT * FROM `mst_staff` WHERE 1';
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute();

            $dbh = null;

            echo "<p>スタッフ一覧</p>";
            echo '<form method="post" action="staff_branch.php">';
            while (true) {
                $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
                if ($rec == false) {break;}
                echo <<< EOM
                <input type="radio" name="staffcode" value = "{$rec['code']}">
                {$rec['name']}<br/>
                EOM;
            
            }
            echo "<input type = 'submit' name = 'disp' value = '参照'>";
            echo "<input type = 'submit' name = 'add' value = '追加'>";
            echo "<input type = 'submit' name = 'edit' value = '修正'>";
            echo "<input type = 'submit' name = 'delete' value = '削除'>";
            echo "</form>";
        } catch (Exception $e) {
            echo 'ただいま障害によりご迷惑をおかけしています｡';
            exit();
        }
            
    ?>

</body>
</html>