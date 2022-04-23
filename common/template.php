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
?>