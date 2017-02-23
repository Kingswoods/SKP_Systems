<?php

session_start();

$user = $_GET['user'];

?>

<!DOCTYPE html>

<html>

    <head>

        <!-- Meta Data -->

        <title> Bruger | SKP Systems</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../resources/images/favicon.ico"/>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

        <!-- Style sheets -->
        <link rel='stylesheet' type='text/css' href='../../resources/stylesheets/jquery.mCustomScrollbar.css'>
        <link rel="stylesheet" type="text/css" href='../../resources/stylesheets/jquery-ui.css'>
        <link rel="stylesheet" type="text/css" href="../../resources/stylesheets/application-71f56208694c67f067f1878a3df1f5ba7c941935.css">

        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="../../resources/scripts/jquery-ui.min.js"></script>
        <script src='../../resources/scripts/jquery.mCustomScrollbar.concat.min.js'></script>
        <script src="../../resources/scripts/application-4a35c0647dfb2fc0a93aec0e01f2b91879e827bf.js" defer></script>

    </head>

    <body>

        <div class="page__container">

            <!-- Header -->

            <header class="header">

                <div class="header__content">

                    <div class="header__inwrap">

                        <!-- Header widget - Logo and nav -->

                        <div class="header__widget" id="meta">

                            <div class="header__title"><a href="../../lager/">SKP</a></div>
                            <div class="header__subtitle"><a href="../../lager/">Lagersystem</a></div>

                        </div>

                        <!-- Header widget - Logo and nav end -->

                        <div class="splitter"></div>

                        <!-- Logo and navigation bar end -->

                        <!-- Search bar -->

                        <form class="search__form" method="get" action="">

                            <input class="textfield" name="search" id="search__text" placeholder="" required="required" type="text">

                            <i class="fa fa-search" aria-hidden="true"></i>

                            <input class="submit" type="submit">

                        </form>

                        <!-- Search bar end -->

                        <div class="splitter splitter__v2"></div>

                        <!-- Navigation menu widget -->

                        <div class='header__widget' id='navigation'>

                            <div class='widget__title'>Navigation</div>

                            <nav class='location__nav'>

                                <ul>
                                    <?php if ($_SESSION['user__type'] == 'admin'): ?>

                                    <li><div class='nav__item' id='ff'><a href='../../ff/'><i class="fa fa-plane" aria-hidden="true"></i>FF Timer</a></div></li>                                   
                                    <li><div class='nav__item' id='vagtplan'><a href='../../vagtplan/'><i class="fa fa-calendar" aria-hidden="true"></i>Vagtplan</a></div></li>
                                    <li><div class='nav__item active' id='lager'><a href='../../lager/'><i class="fa fa-archive" aria-hidden="true"></i>Lager</a></div></li>

                                    <?php endif; ?>

                                </ul>

                            </nav>

                        </div>

                        <!-- Navigation menu widget end -->
                        
                        <!-- View menu widget -->
                        
                        <div class='header__widget' id='views'>

                            <div class='widget__title'>Views</div>

                            <nav class='location__nav'>

                                <ul>
                                    <?php if ($_SESSION['user__type'] == 'lager'): ?>
                                    
                                    <li><div class='nav__item active' id='lager'><a href='../../lager/'><i class="fa fa-archive" aria-hidden="true"></i>Varer på lager</a></div></li>
                                    
                                    <?php endif; ?>
                                    
                                    <li><div class='nav__item' id='temp'><a href='../../lager/temp/'><i class="fa fa-truck" aria-hidden="true"></i>Midlertidige udlån</a></div></li>
                                    <li><div class='nav__item' id='perm'><a href='../../lager/perm/'><i class="fa fa-hdd-o" aria-hidden="true"></i>Permanente udlån</a></div></li>
                                    <li><div class='nav__item' id='kunder'><a href='../../lager/kunder/'><i class="fa fa-users" aria-hidden="true"></i>Kundeoversigt</a></div></li>
                                </ul>

                            </nav>

                        </div>
                        
                        <!-- View menu widget end -->

                        <!-- Administration menu widget -->

                        <div class='header__widget' id='administration'>

                            <div class='widget__title'>Administration</div>

                            <nav class='location__nav'>

                                <ul>
                                    <li><div class='nav__item' id='warehouse__history'><a href='../../lager/historik/'><i class="fa fa-history" aria-hidden="true"></i>Historik</a></div></li>
                                    <li><div class='nav__item' id='sign__out'><a href="../../resources/utilities/account__handler.php?task=sign__out"><i class="fa fa-sign-out" aria-hidden="true"></i>Log af</a></div></li>
                                </ul>

                            </nav>

                        </div>

                        <!-- Administration menu widget end -->

                        <!-- Header footer - Copyright -->

                        <div class="header__footer">

                            <div class="copyright">

                                <i class="fa fa-copyright" aria-hidden="true"></i>

                                Michael Gregersen, Omar Mohammad
                                <br>
                                & Christian Dahl

                            </div>

                        </div>

                        <!-- Header footer - Copyright end -->

                    </div>

                </div>

            </header>
            
            <!-- Main content container -->

            <div class='main__content' id='temp__overview'>

                <div class='main__inwrap'>

                    <!-- Main content nav bar -->

                    <ol class='main__nav pull__right'>

                        

                    </ol>

                    <!-- Main content nav bar end -->

                    <div class='content__title'>Udlån for <?php echo $user; ?> <span class='expired'>(Udløbede)</span></div>

                    <!-- Main panel with expired items -->

                    <div class='row'>

                        <div class='column__100'>

                            <div class='content__panel panel__main'>

                                <?php include '../../resources/content__loaders/user__load__expired.php'; ?>

                            </div>

                        </div>

                    </div>

                    <!-- Main panel with expired items end -->

                    <div class='content__title'>Udlån for <?php echo $user; ?><span> (Midlertidige)</span></div>

                    <!-- Main panel with items not yet expired -->

                    <div class='row'>

                        <div class='column__100'>

                            <div class='content__panel panel__secondary'>

                                <?php include '../../resources/content__loaders/user__load__temp.php'; ?>

                            </div>

                        </div>

                    </div>

                    <!-- Main panel with items not yet expired end -->
                    
                    <!-- Main panel with expired items end -->

                    <div class='content__title'>Udlån for <?php echo $user; ?><span> (Permanente)</span></div>

                    <!-- Main panel with items not yet expired -->

                    <div class='row'>

                        <div class='column__100'>

                            <div class='content__panel panel__secondary'>

                                <?php include '../../resources/content__loaders/user__load__perm.php'; ?>

                            </div>

                        </div>

                    </div>

                    <!-- Main panel with items not yet expired end -->

                </div>

            </div>

            <!-- Main content container end -->

        </div>

    </body>

</html>

