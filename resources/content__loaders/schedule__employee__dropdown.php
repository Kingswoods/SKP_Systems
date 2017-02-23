<?php

    //Include database variables
    include '../resources/utilities/conn.php';
    
    //Create MySQL object
    $con = new mysqli($servername, $username, $password, 'skp__systems');
    
    //Test connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->error);
    }
    
    $con->set_charset('utf8');
    
    $employee__query = $con->prepare("SELECT employee__id, full__name FROM user__employees WHERE visible__ff = 1 ORDER BY full__name");
    $employee__query->execute();
    $result = $employee__query->get_result();
    
    echo '<select id="employee__dropdown" class="table__dropdown">';
    
    while ($row = $result->fetch_assoc())
    {
        echo '<option value=' . $row['employee__id'] . '>' . $row['full__name'] . '</option>';
    }
    
    echo '</select>';
    
    $con->close();
    
?>