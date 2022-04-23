<?php
    function headerTemp($myPageLinkOrSuggestLogin,$countOfProduct)
    {
        echo <<<EOM
        <header>
            <p>ろくまる農園</p>
            $myPageLinkOrSuggestLogin
            <button onclick="location.href='./shop_cartlook.php'"> $countOfProduct カート</button>
        </header>
        EOM;
    }

    function oftenUseHeadInf(){
        echo <<<EOM
        <!-- css -->
        <link rel="stylesheet" href="../scss/shop_css/shop_header.css">

        <!-- google webフォント -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <!-- mochipopFont -->
        <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap" rel="stylesheet">
        EOM;
    }
?>