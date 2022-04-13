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
        $staff_code  = $_POST['code'];
        $staff_name  = $_POST['name'];
        $staff_pass  = $_POST['pass'];
        $staff_pass2 = $_POST['pass2'];

        //フラグ
        $staff_name_ok  = false;
        $staff_pass_ok  = false;
        $staff_pass2_ok = false;

        $staff_name  = htmlspecialchars($staff_name ,ENT_QUOTES,'UTF-8');
        $staff_pass  = htmlspecialchars($staff_pass ,ENT_QUOTES,'UTF-8');
        $staff_pass2 = htmlspecialchars($staff_pass2,ENT_QUOTES,'UTF-8');

        if ($staff_name == '') { //staff_nameになにもなかった場合
            echo '<p>スタッフ名が入力されていません</p>';
        } else {
            $staff_name_ok = true;
            echo "<p>スタッフ名</p>";
            echo "<p>{$staff_name}</p>";
        }
        if ($staff_pass == '') { //staff_passになにもなかった場合
            echo '<p>パスワードが入力されていません</p>';
        } else {
            $staff_pass_ok = true;
            echo "<p>パスワード</p>";
            echo "<p>{$staff_pass}</p>";
        }
        if ($staff_pass != $staff_pass2) { //staff_passになにもなかった場合
            echo '<p>パスワードがいっちしません</p>';
        } else {$staff_pass2_ok = true;}

        if ($staff_name_ok == true && $staff_pass_ok == true && $staff_pass2_ok) {
            $staff_pass = md5($staff_pass); //md5で暗号化
            
            echo <<< EOM
            <form method = "post" action="staff_edit_done.php">
                <input type="hidden" name = "code" value = "{$staff_code}">
                <input type="hidden" name = "name" value = "{$staff_name}">
                <input type="hidden" name = "pass" value = "{$staff_pass}">
                <br/>
                <input type="button" onclick = "history.back()" value = "戻る">
                <input type="submit" value="ok">
            </form>
            EOM;
            
        } else {
            echo <<< EOM
                <form action="">
                    <input type="button" onclick = "history.back()" value = "戻る">
                </form>
            EOM;
        }
    ?>
</body>
</html>