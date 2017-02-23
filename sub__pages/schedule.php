<?php

session_start();

if ($_SESSION['user__type'] != 'admin'):
    
    header('Location: ../../');

else: 

    $page = $_SERVER['PHP_SELF'];
    
?>

<!DOCTYPE html>
<html>

    <head>

        <!-- Meta Data -->
        <title>Vagtplan | SKP Systems</title>
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
        <script src="../resources/scripts/application-11e9ba26c91a2db7452a5ef9ff7051e19b6b377a.js" defer></script>

    </head>

    <body>

        <div class="page__container">
            
            <?php include '../resources/includes/application__header.php'; ?>

            <?php include '../resources/includes/application__content.php'; ?>
            
        </div>

    </body>

</html>

<?php endif; ?>