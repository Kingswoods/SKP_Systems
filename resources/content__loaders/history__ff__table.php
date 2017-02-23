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
    $history__query = $con->prepare('SELECT * FROM log__ff ORDER BY created__date DESC LIMIT 50');
    $history__query->execute();
    $history__result = $history__query->get_result();
    
    if ($history__result->num_rows > 0)
    {
        //Output table header
        echo '<table class="table table__striped table__main table__ff__history">';
            echo '<thead>';
                echo '<tr>';
                    echo '<th>Bruger</th>';
                    echo '<th>Action</th>';
                    echo '<th>Nuværende saldo</th>';
                    echo '<th>Brugt saldo</th>';
                    echo '<th>Optjent saldo</th>';
                    echo '<th>Tidspunkt</th>';
                echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            //Loop through items in resultset and output into the table
            while($row = $history__result->fetch_assoc())
            {
                //If the target is everybody replace the numbers with X's
                if($row['target'] == 'Alle elever')
                {
                    echo '<tr>';
                        echo '<td>'.$row['target'].'</td>';
                        echo '<td>'.$row['action'].'</td>';
                        
                        //Assign class based on whether differential is positive or negative for current ff
                        if ($row['current__differential'] > 0)
                        {
                            echo '<td>X <span class="positive">( +'.$row['current__differential'].' )</span></td>';
                        }
                        else
                        {
                            echo '<td>X <span class="negative">( '.$row['current__differential'].' )</span></td>';
                        }
                        
                        //Assign class based on whether differential is positive or passive for used ff
                        if ($row['used__differential'] == 0)
                        {
                            echo '<td>X <span class="passive">( '.$row['used__differential'].' )</span></td>';
                        }
                        else
                        {
                            echo '<td>X <span class="positive">( +'.$row['used__differential'].' )</span></td>';
                        }
                        
                        //Assign class based on whether differential is positive or passive for total ff
                        if ($row['total__differential'] == 0)
                        {
                            echo '<td>X <span class="passive">( '.$row['total__differential'].' )</span></td>';
                        }
                        else
                        {
                            echo '<td>X <span class="positive">( +'.$row['total__differential'].' )</span></td>';
                        }
                    
                        echo '<td>'.date("d/m/Y H:i", strtotime($row['created__date'])).'</td>';
                    echo '</tr>';
                }
                else
                {
                    echo '<tr>';
                        echo '<td>'.$row['target'].'</td>';
                        echo '<td>'.$row['action'].'</td>';
                    
                        //Assign class based on whether differential is positive or negative for current ff
                        if ($row['current__differential'] > 0)
                        {
                            echo '<td>'.$row['current__ff'].' <span class="positive">( +'.$row['current__differential'].' )</span></td>';
                        }
                        else
                        {
                            echo '<td>'.$row['current__ff'].' <span class="negative">( '.$row['current__differential'].' )</span></td>';
                        }

                        //Assign class based on whether differential is positive or passive for used ff
                        if ($row['used__differential'] == 0)
                        {
                            echo '<td>'.$row['used__ff'].' <span class="passive">( '.$row['used__differential'].' )</span></td>';
                        }
                        else
                        {
                            echo '<td>'.$row['used__ff'].' <span class="positive">( +'.$row['used__differential'].' )</span></td>';
                        }

                        //Assign class based on whether differential is positive or passive for total ff
                        if ($row['total__differential'] == 0)
                        {
                            echo '<td>'.$row['total__ff'].' <span class="passive">( '.$row['total__differential'].' )</span></td>';
                        }
                        else
                        {
                            echo '<td>'.$row['total__ff'].' <span class="positive">( +'.$row['total__differential'].' )</span></td>';
                        }
                    
                        echo '<td>'.date("d/m/Y H:i", strtotime($row['created__date'])).'</td>';
                    echo '</tr>';
                }
                
            }
            
            echo '</tbody>';
        echo '</table>';
        
        $history__query->free_result();
        
        $history__query->close();
    }
    else 
    {
        //Output table header
        echo '<table class="table table__striped table__main">';
            echo '<thead>';
                echo '<tr>';
                    echo '<th>Brugernavn</th>';
                    echo '<th>Action</th>';
                    echo '<th>Nuværende saldo</th>';
                    echo '<th>Brugt saldo</th>';
                    echo '<th>Optjent saldo</th>';
                    echo '<th>Tidspunkt</th>';
                echo '</tr>';
            echo '</thead>';
        echo '</table>';
        echo '<div class="no__results">Ingen historik blev fundet.</div>';
    }