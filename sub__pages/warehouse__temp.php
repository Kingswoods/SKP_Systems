<?php

session_start();

if (!$_SESSION['user__id']):
    
    header('Location: ../../');

else: 

    $page = $_SERVER['PHP_SELF'];
    
?>

<!DOCTYPE html>
<html>

    <head>

        <!-- Meta Data -->
        <title>Lagersystem | SKP Systems</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../../resources/images/favicon.ico"/>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

        <!-- Style sheets -->
        <link rel='stylesheet' type='text/css' href='../../resources/stylesheets/jquery.mCustomScrollbar.css'>
        <link rel='stylesheet' type='text/css' href='../../resources/stylesheets/jquery-ui.css'>
        <link rel="stylesheet" type="text/css" href="../../resources/stylesheets/application-71f56208694c67f067f1878a3df1f5ba7c941935.css">

        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src='../../resources/scripts/jquery-ui.min.js'></script>
        <script src='../../resources/scripts/jquery.mCustomScrollbar.concat.min.js'></script>
        <script src="../../resources/scripts/application-4a35c0647dfb2fc0a93aec0e01f2b91879e827bf.js" defer></script>

    </head>

    <body>

        <div class="page__container">
            
            <?php include '../resources/includes/application__header.php'; ?>

            <?php include '../resources/includes/application__content.php'; ?>

            <?php include '../resources/includes/return__modal.php'; ?>
            
            <?php include '../resources/includes/create__customer__modal.php'; ?>
            
            <?php include '../resources/includes/create__item__modal.php'; ?>
            
            <?php include '../resources/includes/loan__modal.php'; ?>
            
        </div>

    </body>

</html>

<?php endif; ?>
