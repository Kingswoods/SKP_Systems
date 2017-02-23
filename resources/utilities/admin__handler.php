<?php

    //Start session
    session_start();
    
    //Include log functions
    include('log__functions.php');

    /**
     * Account handler:
     *
     * > Sign in
     * > Create user
     * > Edit user
     * > Delete user
     * > Sign out
     */

    //Check for a $_POST['task'] variable - If one was passed, send it through a switch to determine what function is needed.
    if (isset($_POST['task']))
    {
        switch($_POST['task'])
    {
        case "sign__in":
            sign__in();
            break;
        case "create__user":
            create__user();
            break;
        case "delete__user":
            delete__user();
            break;
        case "edit__user":
            edit__user();
            break;
        }
    }
     
    //Check for a $_GET['task'] variable if no post was passed.
    else if(isset($_GET['task']))
    {
        switch($_GET['task'])
        {
            case "sign__out":
                sign__out();
                break;
        }
    }
     
    /* ==========================================================================
                                Post Functions
       ========================================================================== */

    /**
     * Function to sign in admin/warehouse users
     */
    function sign__in()
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

        //Get username from Ajax
        $username = $_POST['username'];

        //Check if the user exists in the database
        $login__query = $con->prepare('SELECT user__id, username, password, privilege FROM user__users WHERE username = ?');
        $login__query->bind_param('s', $username);
        $login__query->execute();
        $login__query->store_result();

        if($login__query->num_rows > 0)
        {
            $login__query->bind_result($user__id, $username, $password, $privilege);
            $login__query->fetch();

            //Verify that passwords match
            if(password_verify($_POST['password'], $password))
            {
                //Create session
                $_SESSION['user__id'] = $user__id;
                
                //Set user__type based on privilege - Either admin or lager
                $_SESSION['user__type'] = $privilege;
                
                //Return succesful to Ajax
                echo 1;

            }
            else
            {
                //Return incorrect password error to ajax.
                echo 2;
            }
        }
        else
        {
            //Return incorrect username to Ajax
            echo 2;
        }

    }
    
    function create__user()
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
        
        //Get data from Ajax
        $username = $_POST['username'];
        $description = $_POST['description'];
        $privilege = $_POST['privilege'];
        
        //Encrypt password with BCRYPT
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        
        //Insert the user into the database
        $create__query = $con->prepare("INSERT INTO user__users (username, password, description, privilege) VALUES (?, ?, ?, ?)");
        $create__query->bind_param('ssss', $username, $password, $description, $privilege);
        
        if($create__query->execute())
        {
            //Insert creation log
            admin__logger($username, 'Bruger oprettet.');
            
            //Return tabel row to ajax to be output on screen
            echo '<tr data-rowid="'.$username.'"><td>'.$username.'</td><td>'.$description.'</td><td class="privilege">'.$privilege.'</td><td><a class="button square__button table__button edit" data-userid="'.$username.'"><i class="fa fa-pencil" aria-hidden="true"></i></a><a class="button square__button table__button delete" data-userid="'.$username.'"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td></tr>';
        }
    }
    
    /**
     * Function to delete an administration or warehouse user.
     * Used by = {
     *              /sub__pages/ff__admin.php
     *           }
     */
    function delete__user()
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
        
        //Get variables from Ajax
        $delete__target = $_POST['target'];
        
        $delete__query = $con->prepare("DELETE FROM user__users WHERE username = ?");
        $delete__query->bind_param('s', $delete__target);
        
        if($delete__query->execute())
        {
            admin__logger($delete__target, 'Bruger slettet.');
            echo 1;
        }
        else
        {
            echo 2;
        }
        
        
    }
    
    function edit__user()
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
        
        //Get data from Ajax
        $username = $_POST['username'];
        $description = $_POST['description'];
        $privilege = $_POST['privilege'];
        
        if ($_POST['password'] == "")
        {
            //Update data without password
            $edit__query = $con->prepare('UPDATE user__users SET username = ?, description = ?, privilege = ? WHERE username = ?');
            $edit__query->bind_param('ssss', $username, $description, $privilege, $username);
            
            if($edit__query->execute())
            {
                echo 1;
            }
            else
            {
                echo 2;
            }
        }
        else
        {
            //Encrypt password with BCRYPT
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            
            //Update data without password
            $edit__query = $con->prepare('UPDATE user__users SET username = ?, password = ?, description = ?, privilege = ? WHERE username = ?');
            $edit__query->bind_param('sssss', $username, $password, $description, $privilege, $username);
            
            if($edit__query->execute())
            {
                echo 1;
            }
            else
            {
                echo 2;
            }
        }
    }
    
    /* ==========================================================================
                                Get Functions
    ========================================================================== */
    
    function sign__out()
    {
        session_start();
        
        //Reset session to an empty array
        $_SESSION = array();
        
        session_unset($_SESSION['user__type']);
        
        //Destroy session
        session_destroy();
        
        header('Location: ../../');
        die();
        
    }
