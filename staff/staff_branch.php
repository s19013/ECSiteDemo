<?php
    session_start();
    session_regenerate_id(true); //あとでここの1文を抜いたphp文をstaff,productにすべて貼り付ける
    if (isset($_SESSION['login'])==false) {
        echo "ログインされてない <br>";
        echo "<a href=../staff_login/staff_login.php>ログイン画面へ</a>";
        exit();
    }
    
    if (isset($_POST['disp'])  == true) {
        if (isset($_POST['staffcode'])  == false ) {
            header("Location:staff_ng.php");
            exit();
        }
        $staff_code = $_POST['staffcode'];
        header("Location:staff_disp.php?staffcode={$staff_code}");
        exit();
    }
    if (isset($_POST['edit']) == true ) {
        if (isset($_POST['staffcode'])  == false) { //ユーザーが変な処理した時用
            header("Location:staff_ng.php");
            exit();
        }
        $staff_code = $_POST['staffcode'];
        header("Location:staff_edit.php?staffcode={$staff_code}");
        exit();
    }

    if (isset($_POST['delete'])  == true) {
        if (isset($_POST['staffcode'])  == false ) {
            header("Location:staff_ng.php");
            exit();
        }
        $staff_code = $_POST['staffcode'];
        header("Location:staff_delete.php?staffcode={$staff_code}");
        exit();
    }
    if (isset($_POST['add'])  == true) {
        $staff_code = $_POST['staffcode'];
        header("Location:staff_add.php");
        exit();
    }
?>