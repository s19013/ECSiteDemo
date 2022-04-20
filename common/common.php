<?php
    function sanitize($before)
    {
        foreach($before as $key=>$value){
            $after[$key] = htmlspecialchars($value,ENT_QUOTES,'UTF-8');
        }

        return $after;
    }
    function pulldown_year()
    {
        echo "<select name='year' id=''>";
        for ($i=18; $i <=22 ; $i++) { echo "<option value=20{$i}>20$i</option>";}
        echo "</select>";
    }

    function pulldown_month()
    {
        echo "<select name='month' id=''>";
        for ($i=1; $i <=12 ; $i++) { echo "<option value={$i}>$i</option>";}
        echo "</select>";
    }

    function pulldown_day()
    {
        echo "<select name='day' id=''>";
        for ($i=1; $i <=31 ; $i++) { echo "<option value={$i}>$i</option>";}
        echo "</select>";
    }
?>