<?php
    //とりあえずこれで全部初期化できたはず
    $dsn  =null;
    $user =null;
    $password='';
    $dbh = null;
    $stmt = null;

    function connectDB()
    {
        $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
        $user = 'root';
        $dbh = new PDO($dsn,$user,$password);
        $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    function actSql($sql = null)
    {
        $stmt = $dbh ->prepare($sql);

    }

    function disconnectDB()
    {
        $dsn  =null;
        $dbh = null;
        $user =null;
        $stmt = null;
    }
?>