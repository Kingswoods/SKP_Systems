<?php
//start session
session_start();
if (isset($_POST['task'])) {
    switch ($_POST['task']) {
        case "list__items":
            list__items($_POST['amount'], $_POST['watchdog']);
            break;
    }
}
/**
 * List X amount of items
 * @param $amount
 * @param $watchdog
 */
function list__items($amount, $watchdog)
{
    //Include database variables
    include('../../resources/utilities/conn.php');
    //Create MySQL object
    $con = new mysqli($servername, $username, $password, 'skp__systems');
    //Test connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    $con->set_charset('UTF8');
    //Get product data from database
    $item__query = $con->prepare("SELECT * FROM warehouse__products ORDER BY sub__category, item__number LIMIT ? OFFSET ?");
    $item__query->bind_param("ii", $amount, $watchdog);
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
        echo '<div class="no__results">Ingen varer blev fundet.</div>';
    }
    $con->close();
}
?>