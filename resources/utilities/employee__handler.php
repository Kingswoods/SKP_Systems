<?php

    //Start session
    session_start();
    
    include('log__functions.php');


    /**
     * User handler:
     *
     * > Update single user
     * > Add X amount of hours to everybody
     * > Remove X amount of hours to everybody
     * > Update the database from AD Server
     *
     */

    //Check for a $_POST['task'] variable - If one was passed, send it through a switch to determine what function is needed.
    if (isset($_POST['task']))
    {
        switch($_POST['task'])
        {
            case "update__user":
                update__user();
                break;
            case "add__x":
                add__x();
                break;
            case "remove__x":
                remove__x();
                break;
            case "update__employees":
                update__employees();
                break;
            case "hide__user":
                hide__user();
                break;
            case "show__user":
                show__user();
                break;
            case "show__week":
                show__week();
                break;
            case "update__schedule":
                update__schedule();
                break;
            case "autocomplete__schedule":
                autocomplete__schedule();
                break;
            case "validate__user":
                validate__user();
                break;
            case "create__temporary":
                create__temporary();
                break;
            case "create__permanent":
                create__permanent();
                break;
            case "return__item":
                return__item();
                break;
            case "create__customer":
                create__customer();
                break;
            case "create__item":
                create__item();
                break;
        }
    }
     
    //Check for a $_GET['task'] variable if no post was passed.
    else if(isset($_GET['task']))
    {
        switch($_GET['task'])
        {
          
        }
    }
    
    /* ==========================================================================
                                Post Functions
    ========================================================================== */
    
    /**
     * Function to update a specific user when current__ff is changed.
     * Used by = {
     *              /sub__pages/ff.php
     *           }
     */
    function update__user()
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
        $user__id = $_POST['user__id'];
        
        //Force current__ff to become an int as it will be used in calculations
        $current__ff = (int)$_POST['current__ff'];
        
        //Get current ff values from the database
        $ff__query = $con->prepare('SELECT current__ff, used__ff, total__ff FROM user__employees WHERE username = ?');
        $ff__query->bind_param('s', $user__id);
        $ff__query->execute();
        $ff__query->bind_result($old__ff, $used__ff, $total__ff);
        $ff__query->fetch();
        
        //Make sure it does not log updates where nothing was changed
        if ($current__ff == $old__ff)
        {
            //Do nothing and return
            return false;
        }
        
        //Calculate new values
        
        //Check if new value is lower than the old value
        if ($current__ff < $old__ff)
        {
            //If the new count is below 0 and the old one was above 0
            if($current__ff < 0 && $old__ff > 0)
            {
                //Calculate the differential based on the new value and add it to used__ff
                $differential = abs($current__ff) + $old__ff;
                $new__used = $used__ff + $differential;
                $new__total = $total__ff;
            }
            //If both values are below 0
            else if($current__ff < 0 && $old__ff < 0)
            {
                //Calculate the differential based on the new value, convert it to a positive number and add it to used__ff
                $differential = $current__ff + abs($old__ff);
                $differential = abs($differential);
                $new__used = $used__ff + $differential;
                $new__total = $total__ff;
            }
            //If new value is 0 and old value was above 0.
            else if($current__ff == 0 && $old__ff > 0)
            {
                //Set the differential to old__ff and add it to used__ff
                $differential = $old__ff;
                $new__used = $used__ff + $differential;
                $new__total = $total__ff;
            }
            //If new value is below zero and old value was 0.
            else if($current__ff < 0 && $old__ff == 0)
            {
                //Convert current__ff to a positive value, assign it as the differential and add it to used__ff
                $differential = abs($current__ff);
                $new__used = $used__ff + $differential;
                $new__total = $total__ff;
            }
            //If both values are above 0
            else
            {
                //Calculate the differential based on the new value and add it to used__ff
                $differential = $old__ff - $current__ff;
                $new__used = $used__ff + $differential;
                $new__total = $total__ff;
            }
            
        }
        //If the new value is higher than the old one
        else
        {
            //If the new count is above 0 and the old one was below 0
            if($current__ff > 0 && $old__ff < 0)
            {
                //Calculate the differential based on the new number and add it to total__ff
                $differential = $current__ff + abs($old__ff);
                $new__total = $total__ff + $differential; 
                $new__used = $used__ff;
            }
            //If both values are below 0
            else if($current__ff < 0 && $old__ff < 0)
            {
                //Convert both values to positive numbers, calculate the differential and add it to total__ff
                $differential = abs($old__ff) - abs($current__ff);
                $new__total = $total__ff + $differential;
                $new__used = $used__ff;
            }
            //If new value is 0 and old value was below 0
            else if($current__ff == 0 && $old__ff < 0)
            {
                //Set the differential to the positive value of old__ff and add it to total__ff
                $differential = abs($old__ff);
                $new__total = $total__ff + $differential;
                $new__used = $used__ff;
            }
            //If new value is above 0 and old value was 0
            else if($current__ff > 0 && $old__ff == 0)
            {
                //Set the differential to current_ff and add it to total__ff
                $differential = $current__ff;
                $new__total = $total__ff + $differential;
                $new__used = $used__ff;
            }
            //If both values are above 0
            else
            {
                //Calculate the different based on the new number and add it to total__ff
                $differential = $current__ff - $old__ff;
                $new__total = $total__ff + $differential;
                $new__used = $used__ff;
            }
                
        }
        
        //Close the statement
        $ff__query->close();
        
        //Update values for user
        $update__query = $con->prepare('UPDATE user__employees SET current__ff = ?, used__ff = ?, total__ff = ? WHERE username = ?');
        $update__query->bind_param('iiis', $current__ff, $new__used, $new__total, $user__id);
        
        if ($update__query->execute())
        {
            //Create log entry
            ff__logger($user__id, $current__ff, $old__ff, $new__used, $new__total, $differential);
            
            $array = array();
            
            //Assign new values to an array to return to Ajax
            $array['current__ff'] = $current__ff;
            $array['old__ff'] = $old__ff;
            $array['differential'] = $differential;
            $array['new__used'] = $new__used;
            $array['new__total'] = $new__total;
            $array['update__code'] = 1;
            
            echo json_encode($array);
        }
        else
        {
            echo 2;
        }
    }
    
    /**
     * Function that adds X amount of hours to everybody
     * Used by = {
     *              /sub__pages/ff.php
     *              /sub__pages/ff__history.php
     *           }
     */
    function add__x()
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
        
        //Get the value from Ajax
        $value = $_POST['value'];
        
        //Loop through all visible employees and remove the values from current__ff and total__ff
        $update__query = $con->prepare('UPDATE user__employees SET current__ff = current__ff + ?, total__ff = total__ff + ? WHERE visible__ff = 1');
        $update__query->bind_param('ii', $value, $value);
        
        if($update__query->execute())
        {
            //Assign variables for logger
            $target = 'Alle elever';
            $current__ff = $value;
            $old__ff = 0;
            $new__used = 0;
            $new__total = 0;
            $differential = $value;
            
            //Create log entry
            ff__logger($target, $current__ff, $old__ff, $new__used, $new__total, $differential);
            echo 1;
        }
        else
        {
            echo 2;
        }
        
        $update__query->close();
        $con->close();
    }
    
    /**
     * Function that removes X amount of hours from everybody
     * Used by = {
     *              /sub__pages/ff.php
     *              /sub__pages/ff__history.php
     *           }
     */
    function remove__x()
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
        
        //Get the value from Ajax
        $value = $_POST['value'];
        
        //Loop through all visible employees and remove the value from current__ff and add it to used__ff
        $update__query = $con->prepare('UPDATE user__employees SET current__ff = current__ff - ?, used__ff = used__ff + ? WHERE visible__ff = 1');
        $update__query->bind_param('ii', $value, $value);
        
        if($update__query->execute())
        {
            //Assign variables for logger
            $target = 'Alle elever';
            $current__ff = 0;
            $old__ff = $value;
            $new__used = 0;
            $new__total = 0;
            $differential = $value;
            
            //Create log entry
            ff__logger($target, $current__ff, $old__ff, $new__used, $new__total, $differential);
            echo 1;
        }
        else
        {
            echo 2;
        }
        
        $update__query->close();
        $con->close();
    }
    
    /**
     * Function to update employees from the AD Server into the SKP System
     * Used by = {
     *              /sub__pages/ff__admin.php
     *           }
     */
    function update__employees()
    {
        //Include LDAP variables
        include('ldap__conn.php');
        
        //Create connection
        $ldapconn = ldap_connect($ldapserver) or die("Could not connect to LDAP server.");
        
        //Set LDAP Protocol version to support UTF-8
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
        
        if ($ldapconn)
        {
            //Bind to LDAP server
            $ldapbind = ldap_bind($ldapconn, $ldapuser, $ldappass) or die ("Error trying to bind: " . ldap_error($ldapconn));
            
            if ($ldapbind)
            {
                
                $result = ldap_search($ldapconn, $ldaptree, "(cn=*)") or die ("Error in search query: " . ldap_error($ldapconn));
                $data = ldap_get_entries($ldapconn, $result);
                
                //Include MySQL Variables
                include('conn.php');
                
                //Create MySQL object
                $con = new mysqli($servername, $username, $password, 'skp__systems');

                //Test connection
                if ($con->connect_error)
                {
                    die("Connection failed: " .  $con->error);
                }
                
                $con->set_charset(utf8);
                
                for($i = 0; $i < $data['count']; $i++)
                {
                    if (isset($data[$i]['samaccountname'][0]))
                    {
                        $full__name = $data[$i]['cn'][0]; //Full name of employee from AD
                        $username = $data[$i]['samaccountname'][0]; //Username of employee from AD
                        
                        $user__query = $con->prepare('SELECT * FROM user__employees WHERE username = ?');
                        $user__query->bind_param('s', $username);
                        $user__query->execute();
                        $user__result = $user__query->get_result();
                        
                        if ($user__result->num_rows > 0)
                        {
                            //Do nothing
                        }
                        else
                        {
                            $ff = 0;
                            $visible = 1;
                            
                            $insert__query = $con->prepare('INSERT INTO user__employees (username, full__name, current__ff, used__ff, total__ff, visible__ff) VALUES (?, ?, ?, ?, ?, ?)');
                            $insert__query->bind_param('ssiiii', $username, $full__name, $ff, $ff, $ff, $visible);
                            $insert__query->execute();
                            
                        }
                    }
                }
                
                $insert__query->close();
                $user__query->close();
                $con->close();
                
            }
            
            ldap_close($ldapconn);
            echo 1;
        }
        else
        {
            echo 2;
        }
    }
    
    /**
     * Function to set user to inactive in case an employee is away for a while
     * Used by = {
     *              /sub__pages/ff.php
     *           }
     */
    function hide__user()
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
        $hide__target = $_POST['target'];
        
        $hide__query = $con->prepare("UPDATE user__employees SET visible__ff = 0 WHERE username = ?");
        $hide__query->bind_param('s', $hide__target);
        
        if ($hide__query->execute())
        {
            admin__logger($hide__target, 'Bruger sat til inaktiv.');
            echo 1;
        }
        else
        {
            echo 2;
        }
    }
    
    /**
     * Function to set user back to visible if it has been hidden
     * Used by = {
     *              /sub__pages/ff__admin.php
     *           }
     */
    function show__user()
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
        $show__target = $_POST['target'];
        
        $show__query = $con->prepare("UPDATE user__employees SET visible__ff = 1 WHERE username = ?");
        $show__query->bind_param('s', $show__target);
        
        if ($show__query->execute())
        {
            admin__logger($show__target, 'Bruger sat til aktiv.');
            echo 1;
        }
        else
        {
            echo 2;
        }
    }
    
    function show__week()
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
        
        $con->set_charset('utf8');
        
        //Get the week from Ajax
        $date = $_POST['date'];
        
        if (!empty($date))
        {
            $date__array = explode("-", $date); //Separate Week number and Year
        }
        
        //Add a zero if week number is 1 decimal
        if ($date__array[0] < 10) 
        {
            $date__array[0] = "0" . $date__array[0];
        }
        
        //Find days of week by week and year
        for ($i = 0, $day = 1; $day <= 7; $day++, $i++) 
        {
            $week__days[$i] = date('Y-m-d', strtotime($date__array[1] . "W" . $date__array[0] . $day));
            $week__days__without__year[$i] = date('d-m', strtotime($date__array[1] . "W" . $date__array[0] . $day));
        }
        
        $employee__watchdog = 0;
        
        // Get all employees id & full name
        $schedule__query = $con->prepare("SELECT * FROM user__employees WHERE visible__ff = 1 ORDER BY full__name");
        $schedule__query->execute();
        $result = $schedule__query->get_result();
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $employee__id[$employee__watchdog] = $row['employee__id'];
                $employee__full__name[$employee__watchdog] = $row['full__name'];
                $employee__watchdog++;
            }
        }
        echo "<div class='schedule'>"
            . "<div class='content__title__week'> - Uge " . $date__array[0] . "</div>"
            . "<table class='table table__striped table__main' id='schedule__table'>"
            . "<thead>"
            . "<tr>"
            . "<th>Navn</td>"
            . "<th>Mandag d. " . $week__days__without__year[0] . "</th>"
            . "<th>Tirsdag d. " . $week__days__without__year[1] . "</th>"
            . "<th>Onsdag d. " . $week__days__without__year[2] . "</th>"
            . "<th>Torsdag d. " . $week__days__without__year[3] . "</th>"
            . "<th>Fredag d. " . $week__days__without__year[4] . "</th>"
            . "</tr>"
            . "</thead>";
        for ($i = 0; $i <= $employee__watchdog; $i++) {
            for ($z = 0; $z <= 5; $z++) {
                $schedule__date = $week__days[$z];
                // Get all existing roles
                $schedule__query = $con->prepare("SELECT role FROM user__schedule WHERE schedule__date=? AND employee__id=?");
                $schedule__query->bind_param("si", $schedule__date, $employee__id[$i]);
                $schedule__query->execute();
                $result = $schedule__query->get_result();
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $employee__role[$i][$z] = $row['role'];
                }
            }
        }
        //  Table body
        echo "<tbody>";
        for ($i = 0; $i < $employee__watchdog; $i++) {
            echo "<tr>"
                . "<td>" . $employee__full__name[$i] . "</td>"
                . "<td><input type='text' maxlength='13' placeholder='SKP,HF,VFU,SYG,STOP' name='schedule__input__color' id='schedule__input' class='form__control dark' data-id__date='" . $employee__id[$i] . "|" . $week__days[0] . "' value='" . $employee__role[$i][0] . "' onchange='schedule__colors();'></td>"
                . "<td><input type='text' maxlength='13' placeholder='SKP,HF,VFU,SYG,STOP' name='schedule__input__color' id='schedule__input' class='form__control dark' data-id__date='" . $employee__id[$i] . "|" . $week__days[1] . "' value='" . $employee__role[$i][1] . "' onchange='schedule__colors();'></td>"
                . "<td><input type='text' maxlength='13' placeholder='SKP,HF,VFU,SYG,STOP' name='schedule__input__color' id='schedule__input' class='form__control dark' data-id__date='" . $employee__id[$i] . "|" . $week__days[2] . "' value='" . $employee__role[$i][2] . "' onchange='schedule__colors();'></td>"
                . "<td><input type='text' maxlength='13' placeholder='SKP,HF,VFU,SYG,STOP' name='schedule__input__color' id='schedule__input' class='form__control dark' data-id__date='" . $employee__id[$i] . "|" . $week__days[3] . "' value='" . $employee__role[$i][3] . "' onchange='schedule__colors();'></td>"
                . "<td><input type='text' maxlength='13' placeholder='SKP,HF,VFU,SYG,STOP' name='schedule__input__color' id='schedule__input' class='form__control dark' data-id__date='" . $employee__id[$i] . "|" . $week__days[4] . "' value='" . $employee__role[$i][4] . "' onchange='schedule__colors();'></td>"
                . "</tr>";
        }
        echo "</tbody>"
            . "</table>"
            . "</div>";
        $con->close();
    }
    
    function update__schedule()
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
        
        $schedule__array = preg_split('/\|/', $_POST['schedule__data']); //Separate each role
        
        $schedule__employee__id = (int)$schedule__array[0];
        $schedule__date = $schedule__array[1];
        $schedule__role = strtoupper($schedule__array[2]);
        
        //Remove whitespace in the beginning of string
        if (preg_match("/^\s/", $schedule__role)) 
        {
            $schedule__role = trim($schedule__role, " ");
        }
        
        if (is_int($schedule__employee__id) == true && strlen($schedule__role) <= 13 && !empty($schedule__role) == true) 
        {
            //Check if date for employee already exist
            $schedule__query = $con->prepare("SELECT * FROM user__schedule WHERE employee__id=? AND schedule__date=?");
            $schedule__query->bind_param("is", $schedule__employee__id, $schedule__date);
            $schedule__query->execute();
            $result = $schedule__query->get_result();
            
            if ($result->num_rows > 0) 
            {
                //Update if exist
                $schedule__query = $con->prepare("UPDATE user__schedule SET role=? WHERE employee__id=? AND schedule__date=?");
                $schedule__query->bind_param("sis", $schedule__role, $schedule__employee__id, $schedule__date);
                if ($schedule__query->execute()) 
                {
                    echo 1; // Success
                } 
                else 
                {
                    echo 2; // Error
                }
            }
            else 
            {
                //Insert if it doesn't exist
                $schedule__query = $con->prepare("INSERT INTO user__schedule (employee__id, schedule__date, role) VALUES (?,?,?)");
                $schedule__query->bind_param("iss", $schedule__employee__id, $schedule__date, $schedule__role);
                
                if ($schedule__query->execute()) 
                {
                    echo 1; // Success
                }
                else
                {
                    echo 2; // Error
                }
            }
        } 
        else if (is_int($schedule__employee__id) == true && empty($schedule__role) == true) 
        {
            //Delete if role is empty
            $schedule__query = $con->prepare("DELETE FROM user__schedule WHERE employee__id=? AND schedule__date=?");
            $schedule__query->bind_param("is", $schedule__employee__id, $schedule__date);
            
            if ($schedule__query->execute()) 
            {
                echo 1; // Success
            }
            else 
            {
                echo 2; // Error
            }
        }
        else
        {
            echo 2; // Error
        }
    }
    
    function autocomplete__schedule()
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
        $employee__id = (int)$_POST['employee__id'];
        $weeks = $_POST['weeks'];
        $year = $_POST['year'];
        $employee__role = strtoupper($_POST['employee__role']);
        $task__status = false;
        
        if (preg_match("/^\s/", $employee__role)) 
        {
            $employee__role = trim($employee__role, " ");
        }
        
        $week__array = explode(",", $weeks); //Separate week numbers
        
        for ($i = 1, $z = 0; $i <= count($week__array); $i++, $z++) 
        {
            $week = $week__array[$z];
            
            //Add a zero if week number is 1 decimal
            if ($week < 10) 
            {
                $week = "0" . $week;
            }
            
            //Find days of a week by $week & $year
            for ($x = 0, $day = 1; $day <= 5; $day++, $x++) 
            {
                $schedule__date[$x] = date('Y-m-d', strtotime($year . "W" . $week . $day));
            }
            
            for ($y = 0; $y <= 4; $y++) 
            {
                if (is_integer($employee__id) == true && strlen($employee__role) <= 13 && !empty($employee__role) == true) 
                {
                    //Check if date for employee already exist
                    $schedule__query = $con->prepare("SELECT * FROM user__schedule WHERE employee__id=? AND schedule__date=?");
                    $schedule__query->bind_param("is", $employee__id, $schedule__date[$y]);
                    $schedule__query->execute();
                    $result = $schedule__query->get_result();
                    
                    if ($result->num_rows > 0) 
                    {
                        //Update if exist
                        $schedule__query = $con->prepare("UPDATE user__schedule SET role=? WHERE employee__id=? AND schedule__date=?");
                        $schedule__query->bind_param("sis", $employee__role, $employee__id, $schedule__date[$y]);
                        
                        if ($schedule__query->execute()) 
                        {
                            $task__status = true; // Success
                        } 
                        else 
                        {
                            $task__status = false; // Error
                        }
                    } 
                    else 
                    {
                        //Insert if it doesn't exist
                        $schedule__query = $con->prepare("INSERT INTO user__schedule (employee__id, role, schedule__date) VALUES (?,?,?)");
                        $schedule__query->bind_param("iss", $employee__id, $employee__role, $schedule__date[$y]);
                        
                        if ($schedule__query->execute()) 
                        {
                            $task__status = true; // Success
                        } 
                        else 
                        {
                            $task__status = false; // Error
                        }
                    }
                } 
                else if (is_int($employee__id) == true && empty($employee__role) == true) 
                {
                    //Delete if role is empty
                    $schedule__query = $con->prepare("DELETE FROM user__schedule WHERE employee__id=? AND schedule__date=?");
                    $schedule__query->bind_param("is", $employee__id, $schedule__date[$y]);
                    
                    if ($schedule__query->execute()) 
                    {
                        $task__status = true; // Success
                    } 
                    else 
                    {
                        $task__status = false; // Error
                    }
                } 
                else 
                {
                    $task__status = false;
                }
            }
        }
        $con->close();
        
        if ($task__status == true) 
        {
            echo 1;
        } 
        else 
        {
            echo 2;
        }
        
    }
    
    function create__temporary()
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
        
        //Get data from ajax
        $username = $_POST['username'];
        $item = str_replace('+', '-', $_POST['item']);
        $date = new DateTime($_POST['date']);
        $date = date_format($date, "Y-m-d");
        $quantity = $_POST['quantity'];
        
        if (strlen($item) < 9)
        {
            $item = '0' . $item;
        }
        
        //Check that the user exists
        $user__query = $con->prepare('SELECT * FROM user__customers WHERE username = ?');
        $user__query->bind_param('s', $username);
        $user__query->execute();
        $user__query->store_result();
        
        if ($user__query->num_rows > 0)
        {
            //Check that the item exists and that there are any left
            $item__query = $con->prepare('SELECT * FROM warehouse__products WHERE item__number = ? AND item__quantity >= ?');
            $item__query->bind_param('si', $item, $quantity);
            $item__query->execute();
            $item__query->store_result();
            
            if($item__query->num_rows > 0)
            {
                //Check if user has any of the items on loan already
                $loan__query = $con->prepare('SELECT * FROM user__loans WHERE item__number = ? AND customer__id = (SELECT customer__id FROM user__customers WHERE username = ?)');
                $loan__query->bind_param('ss', $item, $username);
                $loan__query->execute();
                $loan__query->store_result();
                
                if ($loan__query->num_rows > 0)
                {
                    //Update users loan with an additional item
                    $update__query = $con->prepare('UPDATE user__loans SET quantity = quantity + ? WHERE item__number = ? AND customer__id = (SELECT customer__id FROM user__customers WHERE username = ?)');
                    $update__query->bind_param('iss', $quantity, $item, $username);
                    
                    if ($update__query->execute())
                    {
                        //update items with the lower quantity
                        $quantity__query = $con->prepare('UPDATE warehouse__products SET item__quantity = item__quantity - ? WHERE item__number = ?');
                        $quantity__query->bind_param('is', $quantity, $item);
                        
                        if ($quantity__query->execute())
                        {
                            //Return succesfully updated;
                            warehouse__logger($username, $item, 'Opdaterede lån med nyt antal');
                            echo 5;
                        }
                        else
                        {
                            //Return error occured updating amount
                            echo 12;
                        }
                        
                        $loan__query->close();
                        $quantity__query-close();
                        $item__query->close();
                        
                    }
                    else
                    {
                        //Return error occured updating loan
                        echo 11;
                    }
                }
                else
                {
                    //Create new loan for the item
                    $create__query = $con->prepare('INSERT INTO user__loans (customer__id, item__number, quantity, loan__expiration) VALUES ((SELECT customer__id FROM user__customers WHERE username = ?), ?, ?, ?)');
                    $create__query->bind_param('ssis', $username, $item, $quantity, $date);
                    
                    if($create__query->execute())
                    {
                        //update items with the lower quantity
                        $quantity__query = $con->prepare('UPDATE warehouse__products SET item__quantity = item__quantity - ? WHERE item__number = ?');
                        $quantity__query->bind_param('is', $quantity, $item);
                        
                        if ($quantity__query->execute())
                        {
                            //Return loan created succesfully
                            if ($quantity == 1)
                            {
                                $action = 'Udlån (' . $quantity . ' vare)';
                            }
                            else
                            {
                                $action = 'Udlån (' . $quantity . ' varer)';
                            }
                            
                            warehouse__logger($username, $item, $action);
                            echo 6;
                        }
                        else
                        {
                            //Return error occured updating amount
                            echo 12;
                        }
                        
                        $create__query->close();
                        $quantity__query->close();
                        $item__query->close();
                    }
                    else
                    {
                        //Return error occured while creating loan
                        echo 13;
                    }
                }
            }
            else
            {
                //Return error that item does not exist or is not available.
                echo 4;
                $item__query->close();
            }
            
        }
        else
        {
            //Return that user does not exist
            echo 3;
        }
        
        $user__query->close();
        
        $con->close();
    }
    
    function create__permanent()
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
        
        //Get data from ajax
        $username = $_POST['username'];
        $item = str_replace('+', '-', $_POST['item']);
        $quantity = $_POST['quantity'];
        
        if (strlen($item) < 9)
        {
            $item = '0' . $item;
        }
        
        //Check that the user exists
        $user__query = $con->prepare('SELECT * FROM user__customers WHERE username = ?');
        $user__query->bind_param('s', $username);
        $user__query->execute();
        $user__query->store_result();
        
        if ($user__query->num_rows > 0)
        {
            //Check that the item exists and that there are any left
            $item__query = $con->prepare('SELECT * FROM warehouse__products WHERE item__number = ? AND item__quantity >= ?');
            $item__query->bind_param('si', $item, $quantity);
            $item__query->execute();
            $item__query->store_result();
            
            if($item__query->num_rows > 0)
            {
                //Check if user has any of the items on loan already
                $loan__query = $con->prepare('SELECT * FROM user__permanent WHERE item__number = ? AND customer__id = (SELECT customer__id FROM user__customers WHERE username = ?)');
                $loan__query->bind_param('ss', $item, $username);
                $loan__query->execute();
                $loan__query->store_result();
                
                if ($loan__query->num_rows > 0)
                {
                    //Update users loan with an additional item
                    $update__query = $con->prepare('UPDATE user__permanent SET quantity = quantity + ? WHERE item__number = ? AND customer__id = (SELECT customer__id FROM user__customers WHERE username = ?)');
                    $update__query->bind_param('iss', $quantity, $item, $username);
                    
                    if ($update__query->execute())
                    {
                        //update items with the lower quantity
                        $quantity__query = $con->prepare('UPDATE warehouse__products SET item__quantity = item__quantity - ? WHERE item__number = ?');
                        $quantity__query->bind_param('is', $quantity, $item);
                        
                        if ($quantity__query->execute())
                        {
                            //Return succesfully updated;
                            warehouse__logger($username, $item, 'Opdaterede permanent lån med nyt antal');
                            echo 5;
                        }
                        else
                        {
                            //Return error occured updating amount
                            echo 12;
                        }
                        
                        $loan__query->close();
                        $quantity__query-close();
                        $item__query->close();
                        
                    }
                    else
                    {
                        //Return error occured updating loan
                        echo 11;
                    }
                }
                else
                {
                    //Create new loan for the item
                    $create__query = $con->prepare('INSERT INTO user__permanent (customer__id, item__number, quantity) VALUES ((SELECT customer__id FROM user__customers WHERE username = ?), ?, ?)');
                    $create__query->bind_param('ssi', $username, $item, $quantity);
                    
                    if($create__query->execute())
                    {
                        //update items with the lower quantity
                        $quantity__query = $con->prepare('UPDATE warehouse__products SET item__quantity = item__quantity - ? WHERE item__number = ?');
                        $quantity__query->bind_param('is', $quantity, $item);
                        
                        if ($quantity__query->execute())
                        {
                            //Return loan created succesfully
                            if ($quantity == 1)
                            {
                                $action = 'Permanent udlån (' . $quantity . ' vare)';
                            }
                            else
                            {
                                $action = 'Permanent udlån (' . $quantity . ' varer)';
                            }
                            
                            warehouse__logger($username, $item, $action);
                            echo 6;
                        }
                        else
                        {
                            //Return error occured updating amount
                            echo 12;
                        }
                        
                        $create__query->close();
                        $quantity__query->close();
                        $item__query->close();
                    }
                    else
                    {
                        //Return error occured while creating loan
                        echo 13;
                    }
                }
            }
            else
            {
                //Return error that item does not exist or is not available.
                echo 4;
                $item__query->close();
            }
            
        }
        else
        {
            //Return that user does not exist
            echo 3;
        }
        
        $user__query->close();
        
        $con->close();
    }
    
    function return__item()
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
        
        //Get data from ajax
        $username = $_POST['username'];
        $item = str_replace('+', '-', $_POST['item']);
        $quantity = $_POST['quantity'];
        
        //Check that the user exists
        $user__query = $con->prepare('SELECT * FROM user__customers WHERE username = ?');
        $user__query->bind_param('s', $username);
        $user__query->execute();
        $user__query->store_result();
        
        if($user__query->num_rows > 0)
        {
            //Check that the item exists
            $item__query = $con->prepare('SELECT * FROM warehouse__products WHERE item__number = ?');
            $item__query->bind_param('s', $item);
            $item__query->execute();
            $item__query->store_result();
            
            if($item__query->num_rows > 0)
            {
                //Check for a temporary loan
                $temp__query = $con->prepare('SELECT quantity FROM user__loans WHERE item__number = ? AND customer__id = (SELECT customer__id FROM user__customers WHERE username = ?)');
                $temp__query->bind_param('ss', $item, $username);
                $temp__query->execute();
                $temp__query->store_result();
                
                if($temp__query->num_rows > 0)
                {
                    $temp__query->bind_result($loaned__quantity);
                    $temp__query->fetch();
                    
                    if ($quantity > $loaned__quantity)
                    {
                        //Return error that user has not borrowed this many.
                        echo 5;
                    }
                    else if($loaned__quantity > $quantity)
                    {
                        $update__query = $con->prepare('UPDATE user__loans SET quantity = quantity - ? WHERE item__number = ? AND customer__id = (SELECT customer__id FROM user__customers WHERE username = ?)');
                        $update__query->bind_param('iss', $quantity, $item, $username);

                        if($update__query->execute())
                        {
                            //update items with the lower quantity
                            $quantity__query = $con->prepare('UPDATE warehouse__products SET item__quantity = item__quantity + ? WHERE item__number = ?');
                            $quantity__query->bind_param('is', $quantity, $item);

                            if($quantity__query->execute())
                            {
                                if ($quantity == 1)
                                {
                                    $action = 'Midlertidig aflevering (' . $quantity . ' vare)';
                                }
                                else
                                {
                                    $action = 'Midlertidig aflevering (' . $quantity . ' varer)';
                                }

                                warehouse__logger($username, $item, $action);

                                //Return that items were returned succesfully.
                                echo 6;
                            }
                            else
                            {
                                //Return that an error occured while updating items
                                echo 20;
                            }
                        }
                        else
                        {
                            //Return that an error occured while updating
                            echo 20;
                        }
                    }
                    else
                    {
                        $delete__query = $con->prepare('DELETE FROM user__loans WHERE item__number = ? AND customer__id = (SELECT customer__id FROM user__customers WHERE username = ?)');
                        $delete__query->bind_param('is', $item, $username);

                        if($delete__query->execute())
                        {
                            //update items with the lower quantity
                            $quantity__query = $con->prepare('UPDATE warehouse__products SET item__quantity = item__quantity + ? WHERE item__number = ?');
                            $quantity__query->bind_param('is', $quantity, $item);

                            if($quantity__query->execute())
                            {
                                if ($quantity == 1)
                                {
                                    $action = 'Midlertidig aflevering (' . $quantity . ' vare)';
                                }
                                else
                                {
                                    $action = 'Midlertidig aflevering (' . $quantity . ' varer)';
                                }

                                warehouse__logger($username, $item, $action);

                                //Return that item was returned succesfully
                                echo 6;
                            }
                            else
                            {
                                //Return that an error occured while returning
                                echo 20;
                            }
                        }
                        else
                        {
                            //Return that an error occured while deleting
                            echo 20;
                        }

                    }
                    
                }
                else
                {
                    //Check for a permanent loan
                    $perm__query = $con->prepare('SELECT quantity FROM user__permanent WHERE item__number = ? AND customer__id = (SELECT customer__id FROM user__customers WHERE username = ?)');
                    $perm__query->bind_param('ss', $item, $username);
                    $perm__query->execute();
                    $perm__query->store_result();
                    
                    if($perm__query->num_rows > 0)
                    {
                        $perm__query->bind_result($loaned__quantity);
                        $perm__query->fetch();
                        
                        if ($quantity > $loaned__quantity)
                        {
                            //Return error that user has not borrowed this many.
                            echo 5;
                        }
                        else if($loaned__quantity > $quantity)
                        {
                            $update__query = $con->prepare('UPDATE user__permanent SET quantity = quantity - ? WHERE item__number = ? AND customer__id = (SELECT customer__id FROM user__customers WHERE username = ?)');
                            $update__query->bind_param('iss', $quantity, $item, $username);

                            if($update__query->execute())
                            {
                                //update items with the lower quantity
                                $quantity__query = $con->prepare('UPDATE warehouse__products SET item__quantity = item__quantity + ? WHERE item__number = ?');
                                $quantity__query->bind_param('is', $quantity, $item);

                                if($quantity__query->execute())
                                {
                                    if ($quantity == 1)
                                    {
                                        $action = 'Permanent aflevering (' . $quantity . ' vare)';
                                    }
                                    else
                                    {
                                        $action = 'Permanent aflevering (' . $quantity . ' varer)';
                                    }

                                    warehouse__logger($username, $item, $action);

                                    //Return that items were returned succesfully.
                                    echo 6;
                                }
                                else
                                {
                                    //Return that an error occured while updating items
                                    echo 20;
                                }
                            }
                            else
                            {
                                //Return that an error occured while updating
                                echo 20;
                            }
                        }
                        else
                        {
                            $delete__query = $con->prepare('DELETE FROM user__permanent WHERE item__number = ? AND customer__id = (SELECT customer__id FROM user__customers WHERE username = ?)');
                            $delete__query->bind_param('is', $item, $username);

                            if($delete__query->execute())
                            {
                                //update items with the lower quantity
                                $quantity__query = $con->prepare('UPDATE warehouse__products SET item__quantity = item__quantity + ? WHERE item__number = ?');
                                $quantity__query->bind_param('is', $quantity, $item);

                                if($quantity__query->execute())
                                {
                                    if ($quantity == 1)
                                    {
                                        $action = 'Permanent aflevering (' . $quantity . ' vare)';
                                    }
                                    else
                                    {
                                        $action = 'Permanent aflevering (' . $quantity . ' varer)';
                                    }

                                    warehouse__logger($username, $item, $action);

                                    //Return that item was returned succesfully
                                    echo 6;
                                }
                                else
                                {
                                    //Return that an error occured while returning
                                    echo 20;
                                }
                            }
                            else
                            {
                                //Return that an error occured while deleting
                                echo 20;
                            }

                        }
                    }
                    else
                    {
                        //Return that the loan doesn't exist
                        echo 7;
                    }
                }
            }
            else
            {
                //Return error that the item doesn't exist.
                echo 4;
            }
        }
        else
        {
            //Return error that user does not exist
            echo 3;
        }
        
        
    }
    
    function create__customer()
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
        $name = $_POST['name'];
        $email = $_POST['mail'];
        $telephone = $_POST['telephone'];
        $type = $_POST['type'];
        
        $user__query = $con->prepare('SELECT * FROM user__customers WHERE username = ?');
        $user__query->bind_param('s', $username);
        $user__query->execute();
        $user__query->store_result();
        
        if($user__query->num_rows > 0)
        {
            //Return that user already exists
            echo 2;
        }
        else
        {
            $create__query = $con->prepare('INSERT INTO user__customers (username, full__name, mail, telephone, customer__type) VALUES (?, ?, ?, ?, ?)');
            $create__query->bind_param('sssss', $username, $name, $email, $telephone, $type);
            
            if($create__query->execute())
            {
                //Return that user was created succesfully
                echo 1;
            }
            else
            {
                //Return that error occured
                echo 20;
            }
        }
    }
    
    function create__item()
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
        
        $item__number = $_POST['item__number'];
        $item__name = $_POST['item__name'];
        $category = $_POST['category'];
        $subcategory = $_POST['subcategory'];
        $description = $_POST['description'];
        $place = $_POST['place'];
        $quantity = $_POST['quantity'];
        
        $item__query = $con->prepare('SELECT * FROM warehouse__products WHERE item__number = ?');
        $item__query->bind_param('s', $item__number);
        $item__query->execute();
        $item__query->store_result();
        
        if($user__query->num_rows > 0)
        {
            //Return that user already exists
            echo 2;
        }
        else
        {
            $create__query = $con->prepare('INSERT INTO warehouse__products (item__number, item__name, item__quantity, category, sub__category, item__space, description) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $create__query->bind_param('sssssss', $item__number, $item__name, $quantity, $category, $subcategory, $place, $description);
            
            if($create__query->execute())
            {
                //Return that user was created succesfully
                echo 1;
            }
            else
            {
                //Return that error occured
                echo 20;
            }
        }
    }
    
    
    
    
?>