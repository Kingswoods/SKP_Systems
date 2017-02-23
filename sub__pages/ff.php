<?php

session_start();

$page = $_SERVER['PHP_SELF'];

?>

<!DOCTYPE html>
<html>

    <head>

        <!-- Meta Data -->
        <title>FF Timer | SKP Systems</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../resources/images/favicon.ico"/>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

        <!-- Style sheets -->
        <link rel='stylesheet' type='text/css' href='../resources/stylesheets/jquery.mCustomScrollbar.css'>
        <link rel="stylesheet" type="text/css" href="../resources/stylesheets/application-71f56208694c67f067f1878a3df1f5ba7c941935.css">

        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src='../resources/scripts/jquery.mCustomScrollbar.concat.min.js'></script>
        <script src="../resources/scripts/application-20fe48dc80290a61f252c4f0147c96349ca1b8ba.js" defer></script>

    </head>

    <body>

        <div class="page__container">
            
            <?php include '../resources/includes/application__header.php'; ?>

            <?php include '../resources/includes/application__content.php'; ?>
            
            <?php include '../resources/includes/confirm__modal.php'; ?>
            
        </div>

    </body>

</html>