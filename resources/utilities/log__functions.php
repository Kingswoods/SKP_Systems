<?php

session_start();

/**
 * Function that logs every time ff is updated
 * @param type $target          //Target user or Everybody
 * @param type $current__ff     //New FF after update
 * @param type $old__ff         //Old FF before update
 * @param type $new__used       //New used after update
 * @param type $new__total      //New total after update
 * @param type $differential    //Differential between new and old ff value
 */
function ff__logger($target, $current__ff, $old__ff, $new__used, $new__total, $differential)
{
    //Include database variables
    include('conn.php');

    //Create MySQL object
    $con = new mysqli($servername, $username, $password, 'skp__systems');

    //Test connection
    if ($con->connect_error)
    {
        die("Connection failed: " .  $con->error);
    }
    
    //Make sure danish characters are inserted correctly.
    $con->set_charset('UTF8');
    
    //Check if hours were added or removed
    if ($current__ff > $old__ff)
    {
        //Set action of change
        $action = "Tilføjede " . $differential . " timer.";
        
        //Set the used differential to 0, as this was not changed.
        $used__differential = 0;
        
        //Insert log into the database
        $log__query = $con->prepare('INSERT INTO log__ff (target, current__ff, current__differential, used__ff, used__differential, total__ff, total__differential, action) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $log__query->bind_param('siiiiiis', $target, $current__ff, $differential, $new__used, $used__differential, $new__total, $differential, $action);
        $log__query->execute();
    }
    else
    {
        //Set action of change
        $action = "Fjernede " . $differential . " timer.";
        
        //As hours were removed, convert the differential to a negative number
        $current__differential = -1 * abs($differential);
        
        //Set the total differential to 0, as this was not changed.
        $total__differential = 0;
        
        //Insert log into the database
        $log__query = $con->prepare('INSERT INTO log__ff (target, current__ff, current__differential, used__ff, used__differential, total__ff, total__differential, action) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $log__query->bind_param('siiiiiis', $target, $current__ff, $current__differential, $new__used, $differential, $new__total, $total__differential, $action);
        $log__query->execute();
    }
    
    //Close the statement
    $log__query->close();
    
    //Close connection
    $con->close();
 
}

/**
 * Function that logs everytime a change is made to an admin user
 * @param type $target              //Username of the account changes has been made to
 * @param type $action              //Change - Creation, Edit or Deletion.
 */
function admin__logger($target, $action)
{
    //Include database variables
    include('conn.php');

    //Create MySQL object
    $con = new mysqli($servername, $username, $password, 'skp__systems');

    //Test connection
    if ($con->connect_error)
    {
        die("Connection failed: " .  $con->error);
    }
    
    //Make sure danish characters are inserted correctly.
    $con->set_charset('UTF8');
    
    //Get ID from session
    $user__id = $_SESSION['user__id'];
    
    $log__query = $con->prepare("INSERT INTO log__administration (target, action, executer) VALUES (?, ?, (SELECT username FROM user__users WHERE user__id = ?))");
    $log__query->bind_param('ssi', $target, $action, $user__id);
    $log__query->execute();
    
    //Close the statement
    $log__query->close();
    
    //Close connection
    $con->close();
}

/**
 * Function that logs everytime an item is lent out or returned and when users and items are created and edited.
 * @param type $user                //Username of the user borrowing/returning or the target of being edited/created.
 * @param type $item                //Item number of the item 
 * @param type $action              //The action that was performed
 */
function warehouse__logger($user, $item, $action)
{
    //Include database variables
    include('conn.php');

    //Create MySQL object
    $con = new mysqli($servername, $username, $password, 'skp__systems');

    //Test connection
    if ($con->connect_error)
    {
        die("Connection failed: " .  $con->error);
    }
    
    //Make sure danish characters are inserted correctly.
    $con->set_charset('UTF8');
    
    $log__query = $con->prepare("INSERT INTO log__warehouse (target, action, item__number) VALUES (?, ?, ?)");
    $log__query->bind_param('sss', $user, $action, $item);
    $log__query->execute();
    
    //Close the statement
    $log__query->close();
    
    //Close connection
    $con->close();
      
}

?>