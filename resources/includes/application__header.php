<?php

session_start();

/* ==========================================================================
                            FF Main Header
   ========================================================================== */

if ($page == '/sub__pages/ff.php'): ?>

    <?php if ($_SESSION['user__type'] == 'admin'): ?>

        <!-- header -->

        <header class="header">

            <div class="header__content">

                <div class="header__inwrap">

                    <!-- Header widget with page name and link to base -->

                    <div class="header__widget" id="meta">

                        <div class="header__title"><a href="../">SKP</a></div>
                        <div class="header__subtitle"><a href="../">FF Timer</a></div>

                    </div>

                    <div class="splitter"></div>

                    <!-- Search bar -->

                    <form class="search__form" method="get" action="">

                        <input class="textfield" name="search" id="search__text" placeholder="" required="required" type="text">

                        <i class="fa fa-search" aria-hidden="true"></i>

                        <input class="submit" type="submit">

                    </form>

                    <div class="splitter splitter__v2"></div>

                    <!-- Navigation menu widget -->

                    <div class='header__widget' id='navigation'>

                        <div class='widget__title'>Navigation</div>

                        <!-- Main navigation between pages -->

                        <nav class='location__nav'>

                            <ul>

                                <li><div class='nav__item active' id='ff'><a href='../ff/'><i class="fa fa-plane" aria-hidden="true"></i>FF Timer</a></div></li>
                                <li><div class='nav__item' id='schedule'><a href='../vagtplan/'><i class="fa fa-calendar" aria-hidden="true"></i>Vagtplan</a></div></li>
                                <li><div class='nav__item' id='lager'><a href='../lager/'><i class="fa fa-archive" aria-hidden="true"></i>Lager</a></div></li>

                            </ul>

                        </nav>

                    </div>

                    <!-- Administration navigation widget -->

                    <div class='header__widget' id='administration'>

                        <div class='widget__title'>Administration</div>

                        <!-- Administration navigation between FF specific pages -->

                        <nav class='location__nav'>

                            <ul>

                                <li><div class='nav__item' id='admin'><a href='../ff/admin/'><i class="fa fa-users" aria-hidden="true"></i>Admin Menu</a></div></li>
                                <li><div class='nav__item' id='history'><a href='../ff/historik/'><i class="fa fa-history" aria-hidden="true"></i>Historik</a></div></li>
                                <li><div class='nav__item' id='sign__out'><a href="../resources/utilities/admin__handler.php?task=sign__out"><i class="fa fa-sign-out" aria-hidden="true"></i>Log af</a></div></li>

                            </ul>

                        </nav>

                    </div>

                    <!-- Header footer - Copyright -->

                    <div class="header__footer">

                        <div class="copyright">

                            <i class="fa fa-copyright" aria-hidden="true"></i>

                            Michael Gregersen, Omar Mohammad 
                            <br>
                            & Christian Dahl

                        </div>

                    </div>

                </div>

            </div>

        </header>
            
    <?php endif; ?>
        
<?php elseif ($page == '/sub__pages/ff__admin.php'): ?>
        
    <!-- Header -->

    <header class="header">

        <div class="header__content">

            <div class="header__inwrap">

                <!-- Header widget with page name and link to base -->

                <div class="header__widget" id="meta">

                    <div class="header__title"><a href="../">SKP</a></div>
                    <div class="header__subtitle"><a href="../">FF Timer</a></div>

                </div>

                <div class="splitter"></div>

                <!-- Search bar -->

                <form class="search__form" method="get" action="">

                    <input class="textfield" name="search" id="search__text" placeholder="" required="required" type="text">

                    <i class="fa fa-search" aria-hidden="true"></i>

                    <input class="submit" type="submit">

                </form>

                <div class="splitter splitter__v2"></div>

                <!-- Navigation menu widget -->

                <div class='header__widget' id='navigation'>

                    <div class='widget__title'>Navigation</div>

                    <nav class='location__nav'>

                        <ul>

                            <li><div class='nav__item' id='ff'><a href='../../ff/'><i class="fa fa-plane" aria-hidden="true"></i>FF Timer</a></div></li>
                            <li><div class='nav__item' id='vagtplan'><a href='../../vagtplan/'><i class="fa fa-calendar" aria-hidden="true"></i>Vagtplan</a></div></li>
                            <li><div class='nav__item' id='lager'><a href='../../lager/'><i class="fa fa-archive" aria-hidden="true"></i>Lager</a></div></li>

                        </ul>

                    </nav>

                </div>

                <!-- Administration navigation widget -->

                <div class='header__widget' id='administration'>

                    <div class='widget__title'>Administration</div>

                    <nav class='location__nav'>

                        <ul>

                            <li><div class='nav__item active' id='admin'><a href='../admin/'><i class="fa fa-users" aria-hidden="true"></i>Admin Menu</a></div></li>
                            <li><div class='nav__item' id='history'><a href='../historik/'><i class="fa fa-history" aria-hidden="true"></i>Historik</a></div></li>
                            <li><div class='nav__item' id='sign__out'><a href="../../resources/utilities/account__handler.php?task=sign__out"><i class="fa fa-sign-out" aria-hidden="true"></i>Log af</a></div></li>

                        </ul>

                    </nav>

                </div>

                <!-- Header footer - Copyright -->

                <div class="header__footer">

                    <div class="copyright">

                        <i class="fa fa-copyright" aria-hidden="true"></i>

                        Michael Gregersen, Omar Mohammad 
                        <br>
                        & Christian Dahl

                    </div>

                </div>

            </div>

        </div>

    </header>
        
<?php elseif ($page == '/sub__pages/ff__history.php'): ?>
    
    <!-- Header -->

    <header class="header">

        <div class="header__content">

            <div class="header__inwrap">

                <!-- Header widget with page name and link to base -->

                <div class="header__widget" id="meta">

                    <div class="header__title"><a href="../">SKP</a></div>
                    <div class="header__subtitle"><a href="../">FF Timer</a></div>

                </div>

                <div class="splitter"></div>

                <!-- Search bar -->

                <form class="search__form" method="get" action="">

                    <input class="textfield" name="search" id="search__text" placeholder="" required="required" type="text">

                    <i class="fa fa-search" aria-hidden="true"></i>

                    <input class="submit" type="submit">

                </form>

                <div class="splitter splitter__v2"></div>

                <!-- Navigation menu widget -->

                <div class='header__widget' id='navigation'>

                    <div class='widget__title'>Navigation</div>

                    <nav class='location__nav'>

                        <ul>

                            <li><div class='nav__item' id='ff'><a href='../../ff/'><i class="fa fa-plane" aria-hidden="true"></i>FF Timer</a></div></li>
                            <li><div class='nav__item' id='vagtplan'><a href='../../vagtplan/'><i class="fa fa-calendar" aria-hidden="true"></i>Vagtplan</a></div></li>
                            <li><div class='nav__item' id='lager'><a href='../../lager/'><i class="fa fa-archive" aria-hidden="true"></i>Lager</a></div></li>

                        </ul>

                    </nav>

                </div>

                <!-- Administration navigation widget -->

                <div class='header__widget' id='administration'>

                    <div class='widget__title'>Administration</div>

                    <nav class='location__nav'>

                        <ul>

                            <li><div class='nav__item' id='admin'><a href='../admin/'><i class="fa fa-users" aria-hidden="true"></i>Admin Menu</a></div></li>
                            <li><div class='nav__item active' id='history'><a href='../historik/'><i class="fa fa-history" aria-hidden="true"></i>Historik</a></div></li>
                            <li><div class='nav__item' id='sign__out'><a href="../../resources/utilities/account__handler.php?task=sign__out"><i class="fa fa-sign-out" aria-hidden="true"></i>Log af</a></div></li>

                        </ul>

                    </nav>

                </div>

                <!-- Header footer - Copyright -->

                <div class="header__footer">

                    <div class="copyright">

                        <i class="fa fa-copyright" aria-hidden="true"></i>

                        Michael Gregersen, Omar Mohammad 
                        <br>
                        & Christian Dahl

                    </div>

                </div>

            </div>

        </div>

    </header>
        
<?php elseif ($page == '/sub__pages/warehouse.php'): ?>
    
    <!-- Header -->

    <header class="header">

        <div class="header__content">

            <div class="header__inwrap">

                <!-- Header widget with page name and link to base -->

                <div class="header__widget" id="meta">

                    <div class="header__title"><a href="../lager/">SKP</a></div>
                    <div class="header__subtitle"><a href="../lager/">Lagersystem</a></div>

                </div>

                <div class="splitter"></div>

                <!-- Search bar -->

                <form class="search__form" method="get" action="">

                    <input class="textfield" name="search" id="search__text" placeholder="" required="required" type="text">

                    <i class="fa fa-search" aria-hidden="true"></i>

                    <input class="submit" type="submit">

                </form>

                <div class="splitter splitter__v2"></div>

                <!-- Navigation menu widget -->
                
                <?php if ($_SESSION['user__type'] == 'admin'): ?>

                <div class='header__widget' id='navigation'>

                    <div class='widget__title'>Navigation</div>

                    <nav class='location__nav'>

                        <ul>
                            
                            <li><div class='nav__item' id='ff'><a href='../ff/'><i class="fa fa-plane" aria-hidden="true"></i>FF Timer</a></div></li>                                   
                            <li><div class='nav__item' id='vagtplan'><a href='../vagtplan/'><i class="fa fa-calendar" aria-hidden="true"></i>Vagtplan</a></div></li>
                            <li><div class='nav__item active' id='lager'><a href='../lager/'><i class="fa fa-archive" aria-hidden="true"></i>Lager</a></div></li>

                        </ul>

                    </nav>

                </div>
                
                <?php endif; ?>

                <!-- View menu widget -->

                <div class='header__widget' id='views'>

                    <div class='widget__title'>Views</div>

                    <nav class='location__nav'>

                        <ul>
                            <?php if ($_SESSION['user__type'] == 'lager'): ?>

                            <li><div class='nav__item active' id='lager'><a href='../lager/'><i class="fa fa-archive" aria-hidden="true"></i>Varer på lager</a></div></li>

                            <?php endif; ?>

                            <li><div class='nav__item' id='temp'><a href='../lager/temp/'><i class="fa fa-truck" aria-hidden="true"></i>Midlertidige udlån</a></div></li>
                            <li><div class='nav__item' id='perm'><a href='../lager/perm/'><i class="fa fa-hdd-o" aria-hidden="true"></i>Permanente udlån</a></div></li>
                            <li><div class='nav__item' id='kunder'><a href='../lager/kunder/'><i class="fa fa-users" aria-hidden="true"></i>Kundeoversigt</a></div></li>
                        </ul>

                    </nav>

                </div>

                <!-- Administration menu widget -->

                <div class='header__widget' id='administration'>

                    <div class='widget__title'>Administration</div>

                    <nav class='location__nav'>

                        <ul>
                            <li><div class='nav__item' id='warehouse__history'><a href='../lager/historik/'><i class="fa fa-history" aria-hidden="true"></i>Historik</a></div></li>
                            <li><div class='nav__item' id='sign__out'><a href="../resources/utilities/account__handler.php?task=sign__out"><i class="fa fa-sign-out" aria-hidden="true"></i>Log af</a></div></li>
                        </ul>

                    </nav>

                </div>

                <!-- Header footer - Copyright -->

                <div class="header__footer">

                    <div class="copyright">

                        <i class="fa fa-copyright" aria-hidden="true"></i>

                        Michael Gregersen, Omar Mohammad
                        <br>
                        & Christian Dahl

                    </div>

                </div>

            </div>

        </div>

    </header>
    
<?php elseif ($page == '/sub__pages/warehouse__customers.php'): ?>
    
    <!-- Header -->

    <header class="header">

        <div class="header__content">

            <div class="header__inwrap">

                <!-- Header widget with page name and link to base -->

                <div class="header__widget" id="meta">

                    <div class="header__title"><a href="../../lager/">SKP</a></div>
                    <div class="header__subtitle"><a href="../../lager/">Lagersystem</a></div>

                </div>

                <div class="splitter"></div>

                <!-- Search bar -->

                <form class="search__form" method="get" action="">

                    <input class="textfield" name="search" id="search__text" placeholder="" required="required" type="text">

                    <i class="fa fa-search" aria-hidden="true"></i>

                    <input class="submit" type="submit">

                </form>

                <div class="splitter splitter__v2"></div>

                <!-- Navigation menu widget -->
                
                <?php if ($_SESSION['user__type'] == 'admin'): ?>

                <div class='header__widget' id='navigation'>

                    <div class='widget__title'>Navigation</div>

                    <nav class='location__nav'>

                        <ul>
                            
                            <li><div class='nav__item' id='ff'><a href='../../ff/'><i class="fa fa-plane" aria-hidden="true"></i>FF Timer</a></div></li>                                   
                            <li><div class='nav__item' id='vagtplan'><a href='../../vagtplan/'><i class="fa fa-calendar" aria-hidden="true"></i>Vagtplan</a></div></li>
                            <li><div class='nav__item' id='lager'><a href='../../lager/'><i class="fa fa-archive" aria-hidden="true"></i>Lager</a></div></li>

                        </ul>

                    </nav>

                </div>
                
                <?php endif; ?>

                <!-- View menu widget -->

                <div class='header__widget' id='views'>

                    <div class='widget__title'>Views</div>

                    <nav class='location__nav'>

                        <ul>
                            <?php if ($_SESSION['user__type'] == 'lager'): ?>

                            <li><div class='nav__item' id='lager'><a href='../../lager/'><i class="fa fa-archive" aria-hidden="true"></i>Varer på lager</a></div></li>

                            <?php endif; ?>

                            <li><div class='nav__item' id='temp'><a href='../../lager/temp/'><i class="fa fa-truck" aria-hidden="true"></i>Midlertidige udlån</a></div></li>
                            <li><div class='nav__item' id='perm'><a href='../../lager/perm/'><i class="fa fa-hdd-o" aria-hidden="true"></i>Permanente udlån</a></div></li>
                            <li><div class='nav__item active' id='kunder'><a href='../../lager/kunder/'><i class="fa fa-users" aria-hidden="true"></i>Kundeoversigt</a></div></li>
                        </ul>

                    </nav>

                </div>

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

                <!-- Header footer - Copyright -->

                <div class="header__footer">

                    <div class="copyright">

                        <i class="fa fa-copyright" aria-hidden="true"></i>

                        Michael Gregersen, Omar Mohammad
                        <br>
                        & Christian Dahl

                    </div>

                </div>

            </div>

        </div>

    </header>

<?php elseif ($page == '/sub__pages/warehouse__temp.php'): ?>
    
    <!-- Header -->

    <header class="header">

        <div class="header__content">

            <div class="header__inwrap">

                <!-- Header widget with page name and link to base -->

                <div class="header__widget" id="meta">

                    <div class="header__title"><a href="../../lager/">SKP</a></div>
                    <div class="header__subtitle"><a href="../../lager/">Lagersystem</a></div>

                </div>

                <div class="splitter"></div>

                <!-- Search bar -->

                <form class="search__form" method="get" action="">

                    <input class="textfield" name="search" id="search__text" placeholder="" required="required" type="text">

                    <i class="fa fa-search" aria-hidden="true"></i>

                    <input class="submit" type="submit">

                </form>

                <div class="splitter splitter__v2"></div>

                <!-- Navigation menu widget -->
                
                <?php if ($_SESSION['user__type'] == 'admin'): ?>

                <div class='header__widget' id='navigation'>

                    <div class='widget__title'>Navigation</div>

                    <nav class='location__nav'>

                        <ul>
                            
                            <li><div class='nav__item' id='ff'><a href='../../ff/'><i class="fa fa-plane" aria-hidden="true"></i>FF Timer</a></div></li>                                   
                            <li><div class='nav__item' id='vagtplan'><a href='../../vagtplan/'><i class="fa fa-calendar" aria-hidden="true"></i>Vagtplan</a></div></li>
                            <li><div class='nav__item' id='lager'><a href='../lager/../'><i class="fa fa-archive" aria-hidden="true"></i>Lager</a></div></li>

                        </ul>

                    </nav>

                </div>
                
                <?php endif; ?>

                <!-- View menu widget -->

                <div class='header__widget' id='views'>

                    <div class='widget__title'>Views</div>

                    <nav class='location__nav'>

                        <ul>
                            <?php if ($_SESSION['user__type'] == 'lager'): ?>

                            <li><div class='nav__item' id='lager'><a href='../../lager/'><i class="fa fa-archive" aria-hidden="true"></i>Varer på lager</a></div></li>

                            <?php endif; ?>

                            <li><div class='nav__item active' id='temp'><a href='../../lager/temp/'><i class="fa fa-truck" aria-hidden="true"></i>Midlertidige udlån</a></div></li>
                            <li><div class='nav__item' id='perm'><a href='../../lager/perm/'><i class="fa fa-hdd-o" aria-hidden="true"></i>Permanente udlån</a></div></li>
                            <li><div class='nav__item' id='kunder'><a href='../../lager/kunder/'><i class="fa fa-users" aria-hidden="true"></i>Kundeoversigt</a></div></li>
                        </ul>

                    </nav>

                </div>

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

                <!-- Header footer - Copyright -->

                <div class="header__footer">

                    <div class="copyright">

                        <i class="fa fa-copyright" aria-hidden="true"></i>

                        Michael Gregersen, Omar Mohammad
                        <br>
                        & Christian Dahl

                    </div>

                </div>

            </div>

        </div>

    </header>
        
<?php elseif ($page == '/sub__pages/warehouse__perm.php'): ?>
    
    <!-- Header -->

    <header class="header">

        <div class="header__content">

            <div class="header__inwrap">

                <!-- Header widget with page name and link to base -->

                <div class="header__widget" id="meta">

                    <div class="header__title"><a href="../../lager/">SKP</a></div>
                    <div class="header__subtitle"><a href="../../lager/">Lagersystem</a></div>

                </div>

                <div class="splitter"></div>

                <!-- Search bar -->

                <form class="search__form" method="get" action="">

                    <input class="textfield" name="search" id="search__text" placeholder="" required="required" type="text">

                    <i class="fa fa-search" aria-hidden="true"></i>

                    <input class="submit" type="submit">

                </form>

                <div class="splitter splitter__v2"></div>

                <!-- Navigation menu widget -->
                
                <?php if ($_SESSION['user__type'] == 'admin'): ?>

                <div class='header__widget' id='navigation'>

                    <div class='widget__title'>Navigation</div>

                    <nav class='location__nav'>

                        <ul>
                            
                            <li><div class='nav__item' id='ff'><a href='../../ff/'><i class="fa fa-plane" aria-hidden="true"></i>FF Timer</a></div></li>                                   
                            <li><div class='nav__item' id='vagtplan'><a href='../../vagtplan/'><i class="fa fa-calendar" aria-hidden="true"></i>Vagtplan</a></div></li>
                            <li><div class='nav__item' id='lager'><a href='../lager/../'><i class="fa fa-archive" aria-hidden="true"></i>Lager</a></div></li>

                        </ul>

                    </nav>

                </div>
                
                <?php endif; ?>

                <!-- View menu widget -->

                <div class='header__widget' id='views'>

                    <div class='widget__title'>Views</div>

                    <nav class='location__nav'>

                        <ul>
                            <?php if ($_SESSION['user__type'] == 'lager'): ?>

                            <li><div class='nav__item' id='lager'><a href='../../lager/'><i class="fa fa-archive" aria-hidden="true"></i>Varer på lager</a></div></li>

                            <?php endif; ?>

                            <li><div class='nav__item' id='temp'><a href='../../lager/temp/'><i class="fa fa-truck" aria-hidden="true"></i>Midlertidige udlån</a></div></li>
                            <li><div class='nav__item active' id='perm'><a href='../../lager/perm/'><i class="fa fa-hdd-o" aria-hidden="true"></i>Permanente udlån</a></div></li>
                            <li><div class='nav__item' id='kunder'><a href='../../lager/kunder/'><i class="fa fa-users" aria-hidden="true"></i>Kundeoversigt</a></div></li>
                        </ul>

                    </nav>

                </div>

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

                <!-- Header footer - Copyright -->

                <div class="header__footer">

                    <div class="copyright">

                        <i class="fa fa-copyright" aria-hidden="true"></i>

                        Michael Gregersen, Omar Mohammad
                        <br>
                        & Christian Dahl

                    </div>

                </div>

            </div>

        </div>

    </header>
        
<?php elseif ($page == '/sub__pages/warehouse__history.php'): ?>
    
    <!-- Header -->

    <header class="header">

        <div class="header__content">

            <div class="header__inwrap">

                <!-- Header widget with page name and link to base -->

                <div class="header__widget" id="meta">

                    <div class="header__title"><a href="../../lager/">SKP</a></div>
                    <div class="header__subtitle"><a href="../../lager/">Lagersystem</a></div>

                </div>

                <div class="splitter"></div>

                <!-- Search bar -->

                <form class="search__form" method="get" action="">

                    <input class="textfield" name="search" id="search__text" placeholder="" required="required" type="text">

                    <i class="fa fa-search" aria-hidden="true"></i>

                    <input class="submit" type="submit">

                </form>

                <div class="splitter splitter__v2"></div>

                <!-- Navigation menu widget -->
                
                <?php if ($_SESSION['user__type'] == 'admin'): ?>

                <div class='header__widget' id='navigation'>

                    <div class='widget__title'>Navigation</div>

                    <nav class='location__nav'>

                        <ul>
                            
                            <li><div class='nav__item' id='ff'><a href='../../ff/'><i class="fa fa-plane" aria-hidden="true"></i>FF Timer</a></div></li>                                   
                            <li><div class='nav__item' id='vagtplan'><a href='../../vagtplan/'><i class="fa fa-calendar" aria-hidden="true"></i>Vagtplan</a></div></li>
                            <li><div class='nav__item' id='lager'><a href='../lager/../'><i class="fa fa-archive" aria-hidden="true"></i>Lager</a></div></li>

                        </ul>

                    </nav>

                </div>
                
                <?php endif; ?>

                <!-- View menu widget -->

                <div class='header__widget' id='views'>

                    <div class='widget__title'>Views</div>

                    <nav class='location__nav'>

                        <ul>
                            <?php if ($_SESSION['user__type'] == 'lager'): ?>

                            <li><div class='nav__item' id='lager'><a href='../../lager/'><i class="fa fa-archive" aria-hidden="true"></i>Varer på lager</a></div></li>

                            <?php endif; ?>

                            <li><div class='nav__item' id='temp'><a href='../../lager/temp/'><i class="fa fa-truck" aria-hidden="true"></i>Midlertidige udlån</a></div></li>
                            <li><div class='nav__item' id='perm'><a href='../../lager/perm/'><i class="fa fa-hdd-o" aria-hidden="true"></i>Permanente udlån</a></div></li>
                            <li><div class='nav__item' id='kunder'><a href='../../lager/kunder/'><i class="fa fa-users" aria-hidden="true"></i>Kundeoversigt</a></div></li>
                        </ul>

                    </nav>

                </div>

                <!-- Administration menu widget -->

                <div class='header__widget' id='administration'>

                    <div class='widget__title'>Administration</div>

                    <nav class='location__nav'>

                        <ul>
                            <li><div class='nav__item active' id='warehouse__history'><a href='../../lager/historik/'><i class="fa fa-history" aria-hidden="true"></i>Historik</a></div></li>
                            <li><div class='nav__item' id='sign__out'><a href="../../resources/utilities/account__handler.php?task=sign__out"><i class="fa fa-sign-out" aria-hidden="true"></i>Log af</a></div></li>
                        </ul>

                    </nav>

                </div>

                <!-- Header footer - Copyright -->

                <div class="header__footer">

                    <div class="copyright">

                        <i class="fa fa-copyright" aria-hidden="true"></i>

                        Michael Gregersen, Omar Mohammad
                        <br>
                        & Christian Dahl

                    </div>

                </div>

            </div>

        </div>

    </header>
        
<?php elseif ($page == '/sub__pages/schedule.php'): ?>
    
    <!-- Header -->

    <header class="header">

        <div class="header__content">

            <div class="header__inwrap">

                <!-- Header widget with page name and link to base -->

                <div class="header__widget" id="meta">

                    <div class="header__title"><a href="../vagtplan">SKP</a></div>
                    <div class="header__subtitle"><a href="../vagtplan">Vagtplan</a></div>

                </div>

                <div class="splitter"></div>

                <!-- Search bar -->

                <form class="search__form" method="get" action="">

                    <input class="textfield" name="search" id="search__text" placeholder="" required="required" type="text">

                    <i class="fa fa-search" aria-hidden="true"></i>

                    <input class="submit" type="submit">

                </form>

                <div class="splitter splitter__v2"></div>

                <!-- Navigation menu widget -->

                <div class='header__widget' id='navigation'>

                    <div class='widget__title'>Navigation</div>

                    <nav class='location__nav'>

                        <ul>

                            <li><div class='nav__item' id='ff'><a href='../ff/'><i class="fa fa-plane" aria-hidden="true"></i>FF Timer</a></div></li>
                            <li><div class='nav__item active' id='vagtplan'><a href='../vagtplan/'><i class="fa fa-calendar" aria-hidden="true"></i>Vagtplan</a></div></li>
                            <li><div class='nav__item' id='lager'><a href='../lager/'><i class="fa fa-archive" aria-hidden="true"></i>Lager</a></div></li>

                        </ul>

                    </nav>

                </div>

                <!-- Administration navigation widget -->

                <div class='header__widget' id='administration'>

                    <div class='widget__title'>Administration</div>

                    <nav class='location__nav'>

                        <ul>

                            <li><div class='nav__item' id='admin'><a href='admin'><i class="fa fa-users" aria-hidden="true"></i>Vagtplan Menu</a></div></li>
                            <li><div class='nav__item' id='sign__out'><a href="../resources/utilities/account__handler.php?task=sign__out"><i class="fa fa-sign-out" aria-hidden="true"></i>Log af</a></div></li>

                        </ul>

                    </nav>

                </div>

                <!-- Header footer - Copyright -->

                <div class="header__footer">

                    <div class="copyright">

                        <i class="fa fa-copyright" aria-hidden="true"></i>

                        Michael Gregersen, Omar Mohammad
                        <br>
                        & Christian Dahl

                    </div>

                </div>

            </div>

        </div>

    </header>
        
<?php elseif ($page == '/sub__pages/schedule__admin.php'): ?>
    
    <!-- Header -->

    <header class="header">

        <div class="header__content">

            <div class="header__inwrap">

                <!-- Header widget with page name and link to base -->

                <div class="header__widget" id="meta">

                    <div class="header__title"><a href="../">SKP</a></div>
                    <div class="header__subtitle"><a href="../">Vagtplan</a></div>

                </div>

                <div class="splitter"></div>

                <!-- Search bar -->

                <form class="search__form" method="get" action="">

                    <input class="textfield" name="search" id="search__text" placeholder="" required="required" type="text">

                    <i class="fa fa-search" aria-hidden="true"></i>

                    <input class="submit" type="submit">

                </form>

                <div class="splitter splitter__v2"></div>

                <!-- Navigation menu widget -->

                <div class='header__widget' id='navigation'>

                    <div class='widget__title'>Navigation</div>

                    <nav class='location__nav'>

                        <ul>

                            <li><div class='nav__item' id='ff'><a href='../../ff/'><i class="fa fa-plane" aria-hidden="true"></i>FF Timer</a></div></li>
                            <li><div class='nav__item' id='vagtplan'><a href='../../vagtplan/'><i class="fa fa-calendar" aria-hidden="true"></i>Vagtplan</a></div></li>
                            <li><div class='nav__item' id='lager'><a href='../../lager'><i class="fa fa-archive" aria-hidden="true"></i>Lager</a></div></li>

                        </ul>

                    </nav>

                </div>

                <!-- Administration menu widget -->

                <div class='header__widget' id='administration'>

                    <div class='widget__title'>Administration</div>

                    <nav class='location__nav'>

                        <ul>

                            <li><div class='nav__item active' id='admin'><a href='../admin'><i class="fa fa-users" aria-hidden="true"></i>Vagtplan Menu</a></div></li>
                            <li><div class='nav__item' id='sign__out'><a href="../../resources/utilities/account__handler.php?task=sign__out"><i class="fa fa-sign-out" aria-hidden="true"></i>Log af</a></div></li>

                        </ul>

                    </nav>

                </div>

                <!-- Header footer - Copyright -->

                <div class="header__footer">

                    <div class="copyright">

                        <i class="fa fa-copyright" aria-hidden="true"></i>

                        Michael Gregersen, Omar Mohammad
                        <br>
                        & Christian Dahl

                    </div>

                </div>

            </div>

        </div>

    </header>

<?php endif; ?>

