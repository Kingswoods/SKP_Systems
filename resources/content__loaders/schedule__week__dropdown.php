<?php

    /**
     * Drop down with weeks from current- & next year
     * Used by = {
     *              /sub__pages/schedule.php
     *           }
     */

    $date = getdate();
    $current__year = $date['year'];
    $next__year = date('Y', strtotime('+1 year'));
    $currentWeek = preg_split("/[0]/", date('W'));
    echo '<select id="week__dropdown">';
    //Current Year
    for ($i = 1; $i <= 52; $i++) {
        if ($i == $currentWeek[1]) {
            echo "<option selected value='" . $i . "-" . $current__year . "'>Uge " . $i . " - " . $current__year . "</option>";
        } else {
            echo "<option value='" . $i . "-" . $current__year . "'>Uge " . $i . " - " . $current__year . "</option>";
        }
    }
    //Next Year
    $i = 1;
    while ($i <= 52) {
        echo "<option value='" . $i . "-" . $next__year . "'>Uge " . $i . " - " . $next__year . "</option>";
        $i++;
    }
    echo "</select>";

?>