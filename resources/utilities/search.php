<?php
//Start session
session_start();
//Check for a $_POST['task'] variable - If one was passed, send it through a switch to determine what function is needed.
if (isset($_POST['task'])) {
    switch ($_POST['task']) {
        case "search__ff__employees":
            search__ff__employees();
            break;
        case "search__schedule__employees":
            search__schedule__employees();
            break;
        case "search__warehouse__items":
            search__warehouse__items();
            break;
    }
}
/**
 * Search for employees in FF
 */
function search__ff__employees()
{
    //Include database variables
    include('conn.php');
    //Create MySQL object
    $con = new mysqli($servername, $username, $password, 'skp__systems');
    //Test connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->error);
    }
    $con->set_charset('UTF8');
    //Get currently visible users from database
    $search__query = $con->prepare("SELECT * FROM user__employees WHERE visible__ff = 1 AND full__name LIKE ? OR username LIKE ? AND visible__ff = 1 ORDER BY full__name");
    $search__key = '%' . $_POST['search__key'] . '%';
    $search__query->bind_param("ss", $search__key, $search__key);
    $search__query->execute();
    $user__result = $search__query->get_result();
    if ($user__result->num_rows > 0) {
        //Loop through items in resultset and output into the table
        while ($row = $user__result->fetch_assoc()) {
            echo '<tr data-rowid="' . $row['username'] . '">';
            echo '<td>' . $row['username'] . '</td>';
            echo '<td>' . $row['full__name'] . '</td>';
            echo '<td><input type="text" class="form__control dark" placeholder="Antal timer" id="current__ff" data-userid="' . $row['username'] . '" value="' . $row['current__ff'] . '"></td>';
            echo '<td id="used__ff" data-userid="' . $row['username'] . '">' . $row['used__ff'] . '</td>';
            echo '<td id="total__ff" data-userid="' . $row['username'] . '">' . $row['total__ff'] . '</td>';
            echo '<td class="hide__button"><a class="button square__button table__button hide" data-userid="' . $row['username'] . '"><i class="fa fa-times" aria-hidden="true"></i></a></td>';
        }
        echo '</tr>';
        $search__query->free_result();
        $search__query->close();
    } else {
        echo '<tr>'
            . '<td class="no__results">Ingen elever blev fundet.</td>'
            . '<td>-</td>'
            . '<td>-</td>'
            . '<td>-</td>'
            . '<td>-</td>'
            . '<td>-</td>'
            . '</tr>';
    }
}
/**
 * Search for employees in Schedule
 */
function search__schedule__employees()
{
    //Include database variables
    include('conn.php');
    //Create MySQL object
    $con = new mysqli($servername, $username, $password, 'skp__systems');
    //Test connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->error);
    }
    $con->set_charset('UTF8');
    //Get the week from Ajax
    $date = $_POST['date'];
    if (!empty($date)) {
        $date__array = explode("-", $date); //Separate Week number and Year
    }
    //Add a zero if week number is 1 decimal
    if ($date__array[0] < 10) {
        $date__array[0] = "0" . $date__array[0];
    }
    //Find days of week by week and year
    for ($i = 0, $day = 1; $day <= 7; $day++, $i++) {
        $week__days[$i] = date('Y-m-d', strtotime($date__array[1] . "W" . $date__array[0] . $day));
        $week__days__without__year[$i] = date('d-m', strtotime($date__array[1] . "W" . $date__array[0] . $day));
    }
    $employee__watchdog = 0;
    // Get all employees id & full name
    $schedule__query = $con->prepare("SELECT * FROM user__employees WHERE visible__ff = 1 AND full__name LIKE ? ORDER BY full__name");
    $search__key = '%' . $_POST['search__key'] . '%';
    $schedule__query->bind_param("s", $search__key);
    $schedule__query->execute();
    $result = $schedule__query->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $employee__id[$employee__watchdog] = $row['employee__id'];
            $employee__full__name[$employee__watchdog] = $row['full__name'];
            $employee__watchdog++;
        }
        for ($i = 0; $i <= $employee__watchdog; $i++) {
            for ($z = 0; $z <= 5; $z++) {
                $schedule__date = $week__days[$z];
                // Get all existing roles
                $schedule__query = $con->prepare("SELECT role FROM user__schedule WHERE schedule__date=? AND employee__id=?");
                $schedule__query->bind_param("si", $schedule__date, $employee__id[$i]);
                $schedule__query->execute();
                $result = $schedule__query->get_result();
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $employee__role[$i][$z] = $row['role'];
                }
            }
        }
        for ($i = 0; $i < $employee__watchdog; $i++) {
            echo "<tr>"
                . "<td>" . $employee__full__name[$i] . "</td>"
                . "<td><input type='text' maxlength='13' placeholder='SKP,HF,VFU,SYG,STOP' name='schedule__input__color' id='schedule__input' class='form__control dark' data-id__date='" . $employee__id[$i] . "|" . $week__days[0] . "' value='" . $employee__role[$i][0] . "' onchange='schedule__colors();'></td>"
                . "<td><input type='text' maxlength='13' placeholder='SKP,HF,VFU,SYG,STOP' name='schedule__input__color' id='schedule__input' class='form__control dark' data-id__date='" . $employee__id[$i] . "|" . $week__days[1] . "' value='" . $employee__role[$i][1] . "' onchange='schedule__colors();'></td>"
                . "<td><input type='text' maxlength='13' placeholder='SKP,HF,VFU,SYG,STOP' name='schedule__input__color' id='schedule__input' class='form__control dark' data-id__date='" . $employee__id[$i] . "|" . $week__days[2] . "' value='" . $employee__role[$i][2] . "' onchange='schedule__colors();'></td>"
                . "<td><input type='text' maxlength='13' placeholder='SKP,HF,VFU,SYG,STOP' name='schedule__input__color' id='schedule__input' class='form__control dark' data-id__date='" . $employee__id[$i] . "|" . $week__days[3] . "' value='" . $employee__role[$i][3] . "' onchange='schedule__colors();'></td>"
                . "<td><input type='text' maxlength='13' placeholder='SKP,HF,VFU,SYG,STOP' name='schedule__input__color' id='schedule__input' class='form__control dark' data-id__date='" . $employee__id[$i] . "|" . $week__days[4] . "' value='" . $employee__role[$i][4] . "' onchange='schedule__colors();'></td>"
                . "</tr>";
        }
    } else {
        echo '<tr>'
            . '<td class="no__results">Ingen elever blev fundet.</td>'
            . '<td>-</td>'
            . '<td>-</td>'
            . '<td>-</td>'
            . '<td>-</td>'
            . '<td>-</td>'
            . '</tr>';
    }
    $con->close();
}
/**
 * Search for items in warehouse
 */
function search__warehouse__items()
{
    //Include database variables
    include('conn.php');
    //Create MySQL object
    $con = new mysqli($servername, $username, $password, 'skp__systems');
    //Test connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->error);
    }
    $con->set_charset('UTF8');
    //Get product data from database
    $item__query = $con->prepare("SELECT * FROM warehouse__products WHERE item__number LIKE ? OR item__name LIKE ? OR category LIKE ? ORDER BY sub__category, item__number");
    $search__key = '%' . $_POST['search__key'] . '%';
    $item__query->bind_param("sss", $search__key, $search__key, $search__key);
    $item__query->execute();
    $item__result = $item__query->get_result();
    if ($item__result->num_rows > 0) {
        //Loop through items in resultset and output into the table
        while ($row = $item__result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['item__number'] . '</td>';
            echo '<td>' . $row['item__name'] . '</td>';
            echo '<td>' . $row['category'] . '</td>';
            echo '<td>' . $row['sub__category'] . '</td>';
            echo '<td>' . $row['description'] . '</td>';
            echo '<td>' . $row['item__space'] . '</td>';
            echo '<td>' . $row['item__quantity'] . '</td>';
            echo '<tr>';
        }
        $item__result->free_result();
        $item__query->close();
    } else {
        echo '<tr>'
            . '<td class="no__results">Ingen varer blev fundet.</td>'
            . '<td>-</td>'
            . '<td>-</td>'
            . '<td>-</td>'
            . '<td>-</td>'
            . '<td>-</td>'
            . '<td>-</td>'
            . '</tr>';
    }
    $con->close();
}
?>