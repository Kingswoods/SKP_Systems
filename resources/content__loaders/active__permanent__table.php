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
    $loan__query = $con->prepare('SELECT * FROM user__permanent INNER JOIN user__customers ON user__permanent.customer__id = user__customers.customer__id INNER JOIN warehouse__products ON user__permanent.item__number = warehouse__products.item__number ORDER BY user__permanent.loan__date DESC');
    $loan__query->execute();
    $loan__result = $loan__query->get_result();
    
    if ($loan__result->num_rows > 0)
    {
        //Output table header
        echo '<table class="table table__striped table__main table__permanent">';
            echo '<thead>';
                echo '<tr>';
                    echo '<th>Brugernavn</th>';
                    echo '<th>Navn</th>';
                    echo '<th>Varenummer</th>';
                    echo '<th>Varenavn</th>';
                    echo '<th>Antal</th>';
                    echo '<th>Udlånt</th>';
                echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            //Loop through items in resultset and output into the table
            while($row = $loan__result->fetch_assoc())
            {
                echo '<tr class="user__link" data-userid='.$row['username'].'>';
                    echo '<td>'.$row['username'].'</td>';
                    echo '<td>'.$row['full__name'].'</td>';
                    echo '<td>'.$row['item__number'].'</td>';
                    echo '<td>'.$row['item__name'].'</td>';
                    echo '<td>'.$row['quantity'].'</td>';
                    echo '<td>'.date("d/m/Y", strtotime($row['loan__date'])).'</td>';
                echo '<tr>';
            }
            
            echo '</tbody>';
        echo '</table>';
            
        $loan__result->free_result();

        $loan__query->close();    
    }
    else
    {
        //Output table header
        echo '<table class="table table__striped table__main">';
            echo '<thead>';
                echo '<tr>';
                    echo '<th>Brugernavn</th>';
                    echo '<th>Navn</th>';
                    echo '<th>Varenummer</th>';
                    echo '<th>Varenavn</th>';
                    echo '<th>Antal</th>';
                    echo '<th>Udlånt</th>';
                echo '</tr>';
            echo '</thead>';
            echo '</table>';
            echo '<div class="no__results">Ingen lån blev fundet.</div>';
    }
    
    

