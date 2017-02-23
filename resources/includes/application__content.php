<?php

session_start();

/* ==========================================================================
                            FF Main Content
   ========================================================================== */

if ($page == '/sub__pages/ff.php'): ?>

    <?php if ($_SESSION['user__type'] == 'admin'): ?>

        <div class='main__content' id='ff__overview'>
            
    <?php else: ?>
            
        <div class='main__content no__session' id='ff__overview'>
            
    <?php endif; ?>
            
            <div class='main__inwrap'>

            <!-- Main content nav bar -->

            <?php if($_SESSION['user__type'] == 'admin'): ?>

                <ol class='main__nav pull__right'>

                    <a class='button square__button button__blue' id="remove__all">

                        Fjern fra alle

                    </a>

                    <input type="text" class="form__control dark nav" placeholder="Antal timer" id="remove__ff" value="">

                    <a class='button square__button button__red' id="add__all">

                        Tilføj til alle

                    </a>

                    <input type="text" class="form__control dark nav" placeholder="Antal timer" id="add__ff" value="">

                </ol>

            <?php endif; ?>

            <div class='content__title'>FF Timer</div>

            <!-- Main panel with every active employee -->

            <div class='row'>

                <div class='column__100'>

                    <div class='content__panel panel__main'>

                        <?php include '../resources/content__loaders/employee__ff__table.php'; ?>

                    </div>

                </div>

            </div>

        </div>
            
        <?php include '../resources/includes/notifications.php'; ?>

    </div>
    
<?php elseif ($page == '/sub__pages/ff__admin.php'): ?>
            
    <!-- Main content container -->

    <div class='main__content' id='admin__overview'>

        <div class='main__inwrap'>

            <!-- Main content nav bar -->

            <ol class='main__nav pull__right'>

                <a id='update__employees' class='button square__button button__blue'>

                    Opdater Elever

                </a>

                <a id='create__user' class='button square__button button__red'>

                    Opret Bruger

                </a>

            </ol>

            <div class='content__title'>Administration</div>

            <!-- Main panel with admin users -->

            <div class='row'>

                <div class='column__100'>

                    <div class='content__panel panel__main'>

                        <?php include '../resources/content__loaders/user__ff__table.php'; ?>

                    </div>

                </div>

            </div>

            <div class='content__title'>Brugere <span class='expired'>(Inaktive)</span></div>

            <!-- Main panel with inactive user accounts -->

            <div class='row'>

                <div class='column__100'>

                    <div class='content__panel panel__main'>

                        <?php include '../resources/content__loaders/inactive__ff__table.php'; ?>

                    </div>

                </div>

            </div>

        </div>

        <?php include '../resources/includes/notifications.php'; ?>

    </div>
        
<?php elseif ($page == '/sub__pages/ff__history.php'): ?>
    
    <!-- Main content container -->

    <div class='main__content' id='history__overview'>

        <div class='main__inwrap'>

            <!-- Main content nav bar -->

            <ol class='main__nav pull__right'>

                <a class='button square__button button__blue remove__hours' id="remove__all">

                    Fjern fra alle


                </a>

                <input type="text" class="form__control dark nav" placeholder="Antal timer" id="remove__ff" value="">

                <a class='button square__button button__red add__hours' id="add__all">

                    Tilføj til alle

                </a>

                <input type="text" class="form__control dark nav" placeholder="Antal timer" id="add__ff" value="">

            </ol>

            <div class='content__title'>Historik (Administration)</div>

            <!-- Main panel with admin log -->

            <div class='row'>

                <div class='column__100'>

                    <div class='content__panel panel__main'>

                        <?php include '../resources/content__loaders/history__admin__table.php'; ?>

                    </div>

                </div>

            </div>

            <div class='content__title'>Historik (FF Timer)</div>

            <!-- Main panel with ff history log -->

            <div class='row'>

                <div class='column__100'>

                    <div class='content__panel panel__main'>

                        <?php include '../resources/content__loaders/history__ff__table.php'; ?>

                    </div>

                </div>

            </div>

            <!-- Main panel with ff history log end -->

        </div>

        <?php include '../resources/includes/notifications.php'; ?>

    </div>
        
<?php elseif ($page == '/sub__pages/warehouse.php'): ?>
    
    <!-- Main content container -->

    <div class='main__content' id='item__overview'>

        <div class='main__inwrap'>

            <!-- Main content nav bar -->

            <ol class='main__nav pull__right'>

                <a class='button square__button button__red' id='return__item'>

                    Returner vare

                </a>
                <a class='button square__button button__blue' id='loan__item'>

                    Udlån vare

                </a>
                <a class='button square__button button__green' id='create__item'>

                    Opret vare

                </a>
                <a class='button square__button button__red' id='create__customer'>

                    Opret kunde

                </a>

            </ol>

            <div class='content__title'>Varer på lager</div>

            <!-- Main panel with items -->

            <div class='row'>

                <div class='column__100'>

                    <div class='content__panel panel__main'>

                        <table class="table table__striped table__main" id="table__warehouse__items">
                            <thead>
                                <tr>
                                    <th>Varenummer</th>
                                    <th>Varenavn</th>
                                    <th>Kategori</th>
                                    <th>Subkategori</th>
                                    <th>Beskrivelse</th>
                                    <th>Placering</th>
                                    <th>Antal</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>

                </div>

            </div>

            <!-- Main panel with items end -->

        </div>

        <?php include '../resources/includes/notifications.php'; ?>

    </div>
    
<?php elseif ($page == '/sub__pages/warehouse__customers.php'): ?>
    
    <!-- Main content container -->

    <div class='main__content' id='temp__overview'>

        <div class='main__inwrap'>
            
            <ol class='main__nav pull__right'>

                <a class='button square__button button__red' id='return__item'>

                    Returner vare

                </a>
                <a class='button square__button button__blue' id='loan__item'>

                    Udlån vare

                </a>
                <a class='button square__button button__green' id='create__item'>

                    Opret vare

                </a>
                <a class='button square__button button__red' id='create__customer'>

                    Opret kunde

                </a>

            </ol>

            <div class='content__title'>Kundeoversigt</div>

            <!-- Main panel with all customers -->

            <div class='row'>

                <div class='column__100'>

                    <div class='content__panel panel__main'>

                        <?php include '../resources/content__loaders/warehouse__load__customers.php'; ?>

                    </div>

                </div>

            </div>

            <!-- Main panel with permanent loans end -->

        </div>

    </div>

<?php elseif ($page == '/sub__pages/warehouse__temp.php'): ?>
    
    <!-- Main content container -->

    <div class='main__content' id='temp__overview'>

        <div class='main__inwrap'>

            <!-- Main content nav bar -->

            <ol class='main__nav pull__right'>

                <a class='button square__button button__red return__sub' id='return__item'>

                    Returner vare

                </a>
                <a class='button square__button button__blue loan__sub' id='loan__item'>

                    Udlån vare

                </a>
                <a class='button square__button button__green sub__item' id='create__item'>

                    Opret vare

                </a>
                <a class='button square__button button__red sub__customer' id='create__customer'>

                    Opret kunde

                </a>

            </ol>

            <div class='content__title'>Midlertidige udlån <span class='expired'>(Udløbet)</span></div>

            <!-- Main panel with expired items -->

            <div class='row'>

                <div class='column__100'>

                    <div class='content__panel panel__main'>

                        <?php include '../resources/content__loaders/expired__temporary__table.php'; ?>

                    </div>

                </div>

            </div>

            <div class='content__title'>Midlertidige udlån <span class='current'>(Aktive)</span></div>

            <!-- Main panel with items not yet expired -->

            <div class='row'>

                <div class='column__100'>

                    <div class='content__panel panel__secondary'>

                        <?php include '../resources/content__loaders/active__temporary__table.php'; ?>

                    </div>

                </div>

            </div>

        </div>

        <?php include '../resources/includes/notifications.php'; ?>

    </div>
        
<?php elseif ($page == '/sub__pages/warehouse__perm.php'): ?>
    
    <!-- Main content container -->

    <div class='main__content' id='perm__overview'>

        <div class='main__inwrap'>

            <!-- Main content nav bar -->

            <ol class='main__nav pull__right'>

                <a class='button square__button button__red return__sub' id='return__item'>

                    Returner vare

                </a>
                <a class='button square__button button__blue loan__sub' id='loan__item'>

                    Udlån vare

                </a>
                <a class='button square__button button__green sub__item' id='create__item'>

                    Opret vare

                </a>
                <a class='button square__button button__red sub__customer' id='create__customer'>

                    Opret kunde

                </a>

            </ol>

            <div class='content__title'>Permanente udlån</div>

            <!-- Main panel with permanent loans -->

            <div class='row'>

                <div class='column__100'>

                    <div class='content__panel panel__main'>

                        <?php include '../resources/content__loaders/active__permanent__table.php'; ?>

                    </div>

                </div>

            </div>

        </div>

    </div>
        
<?php elseif ($page == '/sub__pages/warehouse__history.php'): ?>
    
    <!-- Main content container -->

    <div class='main__content' id='history__overview'>

        <div class='main__inwrap'>

            <!-- Main content nav bar -->

            <ol class='main__nav pull__right'>

                <a class='button square__button button__red return__sub' id='return__item'>

                    Returner vare

                </a>
                <a class='button square__button button__blue loan__sub' id='loan__item'>

                    Udlån vare

                </a>
                <a class='button square__button button__green sub__item' id='create__item'>

                    Opret vare

                </a>
                <a class='button square__button button__red sub__customer' id='create__customer'>

                    Opret kunde

                </a>

            </ol>

            <div class='content__title'>Historik</div>

            <!-- Main panel with history log -->

            <div class='row'>

                <div class='column__100'>

                    <div class='content__panel panel__main'>

                        <?php include '../resources/content__loaders/history__warehouse__table.php'; ?>

                    </div>

                </div>

            </div>

        </div>
        
        <?php include '../resources/includes/notifications.php'; ?>

    </div>
        
<?php elseif ($page == '/sub__pages/schedule.php'): ?>
    
    <!-- Main content container -->

    <div class='main__content' id='schedule__overview'>

        <div class='main__inwrap'>

            <!-- Main content nav bar -->

            <ol class='main__nav pull__right'>

                <?php include '../resources/content__loaders/schedule__week__dropdown.php'; ?>

            </ol>

            <div class='content__title'>Vagtplan </div>

            <!-- Main panel with projects -->

            <div class='row'>

                <div class='column__100'>

                    <div class='content__panel panel__main' id="schedule__panel">

                    </div>

                </div>

            </div>

            <!-- Main panel with projects end -->

        </div>

        <?php include '../resources/includes/notifications.php'; ?>

    </div>
        
<?php elseif ($page == '/sub__pages/schedule__admin.php'): ?>
    
    <!-- Main content container -->

    <div class='main__content' id='admin__overview'>

        <div class='main__inwrap schedule__admin__inwrap'>

        <div class='content__title'>Vagtplan - Settings</div>

        <!-- Main panel with projects -->

        <div class='row'>

            <div class='column__100'>

                <div class='content__panel panel__main' id="schedule__panel__settings">

                    <table class='table table__striped table__main' id='schedule__table'>

                        <thead>
                        <tr>
                            <th>Personer</th>
                            <th>Uger</th>
                            <th>År</th>
                            <th>Rolle</th>
                            <th>Handling</th>
                        </tr>
                        </thead>

                        <tbody>

                        <tr>
                            <td>
                                <?php include '../resources/content__loaders/schedule__employee__dropdown.php'; ?>
                            </td>
                            <td>
                                <input type='text' id="weeks__input" placeholder='F.eks. 1,2,3,42,43,44'
                                       class='form__control dark'>
                            </td>
                            <td>
                                <?php include '../resources/content__loaders/schedule__year__dropdown.php'; ?>
                            </td>
                            <td>
                                <input type='text' id="role__input"
                                       name="schedule__input__color"
                                       placeholder='SKP,HF,VFU,SYG'
                                       class='form__control dark'
                                       onchange='schedule__colors();'>
                            </td>
                            <td>
                                <button type="submit" id="autocomplete__week__submit"
                                        class="button square__button button__red">Gem
                                </button>
                            </td>
                        </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Main panel with projects end -->

</div>

<?php include '../resources/includes/notifications.php'; ?>

</div>

<?php endif; ?>

