
<?php
//start session
session_start();
//Include database variables
include('../resources/utilities/conn.php');
//Create MySQL object
$con = new mysqli($servername, $username, $password, 'skp__systems');
//Test connection
if ($con->connect_error)
{
    die("Connection failed: " . $con->connect_error);
}
$con->set_charset('UTF8');
//Get product data from database
$loan__query = $con->prepare('SELECT * FROM user__customers ORDER BY username ASC');
$loan__query->execute();
$loan__result = $loan__query->get_result();
if ($loan__result->num_rows > 0)
{
    //Output table header
    echo '<table class="table table__striped table__main table__customers">';
        echo '<thead>';
            echo '<tr>';
                echo '<th>Brugernavn</th>';
                echo '<th>Navn</th>';
                echo '<th>Email</th>';
                echo '<th>Telefon</th>';
                echo '<th>Type</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    //Loop through items in resultset and output into the table
    while($row = $loan__result->fetch_assoc())
    {
        echo '<tr class="user__link" data-userid='.$row['username'].'>';
            echo '<td>'.$row['username'].'</td>';
            echo '<td>'.$row['full__name'].'</td>';
            echo '<td>'.$row['mail'].'</td>';
            echo '<td>'.$row['telephone'].'</td>';
            echo '<td>'.$row['customer__type'].'</td>';
        echo '<tr>';
    }
    echo '</tbody>';
    echo '</table>';
    $loan__result->free_result();
    $loan__query->close();
}
