<?php

    //Start session
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
    
    //Get history from database
    $history__query = $con->prepare('SELECT * FROM log__warehouse ORDER BY created__date DESC LIMIT 50');
    $history__query->execute();
    $history__result = $history__query->get_result();
    
    if ($history__result->num_rows > 0)
    {
        //Output table header
        echo '<table class="table table__striped table__main table__warehouse__history">';
            echo '<thead>';
                echo '<tr>';
                    echo '<th>Bruger</th>';
                    echo '<th>Action</th>';
                    echo '<th>Varenummer</th>';
                    echo '<th>Tidspunkt</th>';
                echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            //Loop through items in resultset and output into the table
            while($row = $history__result->fetch_assoc())
            {
                echo '<tr>';
                    echo '<td>'.$row['target'].'</td>';
                    echo '<td>'.$row['action'].'</td>';
                    echo '<td>'.$row['item__number'].'</td>';
                    echo '<td>'.date("d/m/Y H:i", strtotime($row['created__date'])).'</td>';
                echo '</tr>';
            }
            
            echo '</tbody>';
        echo '</table>';
        
        $history__query->free_result();
        
        $history__query->close();
    }
    else 
    {
        //Output table header
        echo '<table class="table table__striped table__main table__admin__history">';
            echo '<thead>';
                echo '<tr>';
                    echo '<th>Bruger</th>';
                    echo '<th>Action</th>';
                    echo '<th>Varenummer</th>';
                    echo '<th>Tidspunkt</th>';
                echo '</tr>';
            echo '</thead>';
        echo '</table>';
        echo '<div class="no__results">Ingen historik blev fundet.</div>';
    }


