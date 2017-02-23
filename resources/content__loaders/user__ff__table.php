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
    $user__query = $con->prepare('SELECT * FROM user__users');
    $user__query->execute();
    $user__result = $user__query->get_result();
    
    if ($user__result->num_rows > 0)
    {
   
        //Output table header
        echo '<table class="table table__striped table__main table__users">';
            echo '<thead>';
                echo '<tr>';
                    echo '<th>Brugernavn</th>';
                    echo '<th>Beskrivelse</th>';
                    echo '<th>Type</th>';
                    echo '<th>Action</th>';
                echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            //Loop through items in resultset and output into the table
            while($row = $user__result->fetch_assoc())
            {
                if($row['user__id'] == $_SESSION['user__id'])
                {
                    echo '<tr data-rowid="'.$row['username'].'">';
                        echo '<td class="table__username">'.$row['username'].'</td>';
                        echo '<td class="table__description">'.$row['description'].'</td>';    
                        echo '<td class="privilege">'.$row['privilege'].'</td>';
                        echo '<td><a class="button square__button table__button edit" data-userid="'.$row['username'].'"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>';
                    echo '</tr>';
                }
                else
                {
                    echo '<tr data-rowid="'.$row['username'].'">';
                        echo '<td class="table__username" data-username="'.$row['username'].'">'.$row['username'].'</td>';
                        echo '<td class="table__description" data-username="'.$row['username'].'">'.$row['description'].'</td>';    
                        echo '<td class="privilege" data-username="'.$row['username'].'">'.$row['privilege'].'</td>';
                        echo '<td><a class="button square__button table__button edit" data-userid="'.$row['username'].'"><i class="fa fa-pencil" aria-hidden="true"></i></a><a class="button square__button table__button delete" data-userid="'.$row['username'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>';
                    echo '</tr>';
                }
                
                
               
            }
        
                
            echo '</tbody>';
        echo '</table>';
        
        $user__query->free_result();
        
        $user__query->close();
    }
