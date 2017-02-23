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
    
    //Get currently visible users from database
    $user__query = $con->prepare('SELECT * FROM user__employees WHERE visible__ff = 0 ORDER BY full__name');
    $user__query->execute();
    $user__result = $user__query->get_result();
    
    if ($user__result->num_rows > 0)
    {
        //Output table header
        echo '<table class="table table__striped table__main table__inactive">';
            echo '<thead>';
                echo '<tr>';
                    echo '<th>Brugernavn</th>';
                    echo '<th>Navn</th>';
                    echo '<th>Nuværende saldo</th>';
                    echo '<th>Brugt saldo</th>';
                    echo '<th>Optjent saldo</th>';
                    echo '<th class="show__button"></th>';
                echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            //Loop through items in resultset and output into the table
            while($row = $user__result->fetch_assoc())
            {
                echo '<tr data-rowid="'.$row['username'].'">';
                    echo '<td>'.$row['username'].'</td>';
                    echo '<td>'.$row['full__name'].'</td>';
                    echo '<td>'.$row['current__ff'].'</td>';
                    echo '<td id="used__ff" data-userid="'.$row['username'].'">'.$row['used__ff'].'</td>';
                    echo '<td id="total__ff" data-userid="'.$row['username'].'">'.$row['total__ff'].'</td>';
                    echo '<td class="show__button"><a class="button square__button table__button show" data-userid="'.$row['username'].'"><i class="fa fa-plus" aria-hidden="true"></i></a></td>';
                echo '</tr>';
            }
    
            echo '</tbody>';
        echo '</table>';
        
        $user__query->free_result();
        
        $user__query->close();
    }
    else
    {
        //Output table header
        echo '<table class="table table__striped table__main">';
            echo '<thead>';
                echo '<tr>';
                    echo '<th>Brugernavn</th>';
                    echo '<th>Navn</th>';
                    echo '<th>Nuværende saldo</th>';
                    echo '<th>Brugt saldo</th>';
                    echo '<th>Optjent saldo</th>';
                echo '</tr>';
            echo '</thead>';
        echo '</table>';
        echo '<div class="no__results">Ingen elever blev fundet.</div>';
    }
    
    
    
?>