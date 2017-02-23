<?php

    $date = getdate();
    $current__year = $date['year'];
    $next__year = date('Y', strtotime('+1 year'));
    
    echo '<select id="year__dropdown" class="table__dropdown">';
        echo "<option selected value=" . $current__year . ">" . $current__year . "</option>";
        echo "<option value=" . $next__year . ">" . $next__year . "</option>";
    echo '</select>';
    
?>