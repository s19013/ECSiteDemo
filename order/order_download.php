<?php
    require_once('../common/common.php')
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
    <p>ダウンロードしたい注文日をえらんでください</p>
    <form action="order_download_done.php" method="post">
        <?php pulldown_year(); ?>
        年
        <?php pulldown_month(); ?>
        月
        <?php pulldown_day(); ?>
        日<br>
        <input type="submit" value="ダウンロード">
    </form>


</body>
</html>