/**
 * 
 * Javascript file for SKP Systems
 * Used by /sub__pages/warehouse.php
 * Used by /sub__pages/warehouse__admin.php
 * Used by /sub__pages/warehouse__temp.php
 * Used by /sub__pages/warehouse__perm.php
 * 
 */

/* ==========================================================================
                          Initialize Scrollbars
   ========================================================================== */

//Initialize custom scrollbar on main content
(function($){
    $(window).on("load",function(){
        $("#item__overview").mCustomScrollbar({
            theme: "minimal-dark",
            scrollInertia: "300",
            callbacks: {
                onTotalScroll: function () {
                    list__items(watchdog += amount);
                }
            }
        });
    });
})(jQuery);

//Initialize custom scrollbar item__content
(function($){
    $(window).on("load",function(){
        $(".item__content").mCustomScrollbar({
            theme: "minimal-dark",
            scrollInertia: "1000"
        });
    });
})(jQuery);

//Initialize custom scrollbar on header
(function($){
    $(window).on("load",function(){
        $(".header").mCustomScrollbar({
            theme: "minimal-dark",
            scrollInertia: "1000"
        });
    });
})(jQuery);

/* ==========================================================================
                        Initialize Date Picker
   ========================================================================== */

$(document).ready(function() {
    
    $( "#date__loan" ).datepicker({
        dateFormat: 'yy-mm-dd',
    });
    
});

/* ==========================================================================
                            On Click Handlers
   ========================================================================== */


$(document).ready(function () {
    
    /* ==========================================================================
                                Modal Triggers
       ========================================================================== */
    
    $(document).on('click', '#loan__item', function() {
        
        if($(this).hasClass('loan__sub'))
        {
            $('#button__loan').addClass('loan__sub');
        }
        
        //Set data-attribute on modal overlay
        $('.modal__overlay').attr('data-modal', "loan__modal");
        
        //Set data-attribute on modal close
        $('.button__cancel').attr('data-modal', "loan__modal");
        
        //Open modal box
        open__modal('loan__modal');
        
    });
    
    $(document).on('click', '#return__item', function() {
        
        if($(this).hasClass('return__sub'))
        {
            $('#button__return').addClass('return__sub');
        }
        
        //Set data-attribute on modal overlay
        $('.modal__overlay').attr('data-modal', "return__modal");
        
        //Set data-attribute on modal close
        $('.button__cancel').attr('data-modal', "return__modal");
        
        //Open modal box
        open__modal('return__modal');
        
    });
    
    $(document).on('click', '#create__customer', function() {
        
        if($(this).hasClass('sub__customer'))
        {
            $('#button__create__customer').addClass('sub__customer');
        }
        
        //Set data-attribute on modal overlay
        $('.modal__overlay').attr('data-modal', "customer__modal");
        
        //Set data-attribute on modal close
        $('.button__cancel').attr('data-modal', "customer__modal");
        
        //Open modal box
        open__modal('customer__modal');
        
    });
    
    $(document).on('click', '#create__item', function() {
        
        if($(this).hasClass('sub__item'))
        {
            $('#button__create__item').addClass('sub__item');
        }
        
        //Set data-attribute on modal overlay
        $('.modal__overlay').attr('data-modal', "item__modal");
        
        //Set data-attribute on modal close
        $('.button__cancel').attr('data-modal', "item__modal");
        
        //Open modal box
        open__modal('item__modal');
        
    });
    
    
    /* ==========================================================================
                                Modal Overlay
       ========================================================================== */
    
    /**
     * On Click Handler for the overlay behind the modal box - Closes modal on click
     * Used by = {
     *              /sub__pages/ff__admin.php
     *           }
     */
    $(document).on('click', '.modal__overlay', function() 
    {
        var modal = $(this).attr('data-modal');
        
        close__modal(modal);
        
    });
    
    /**
     * On Click Handler for the cancel button in the confirm modal
     * Used by = {
     *              /sub__pages/ff__admin.php
     *           }
     */
    $(document).on('click', '.button__cancel', function() 
    {
        var modal = $(this).attr('data-modal');
        
        //Close the modal box and do nothing else
        close__modal(modal);
    });
    
    /* ==========================================================================
                        Loan/Return On click handlers
       ========================================================================== */
    
    $('#item__loan').keypress(function(e)
    {
       if(e.which == 13) e.preventDefault();
       
    });
    
    $('#item__return').keypress(function(e)
    {
       if(e.which == 13) e.preventDefault();
       
    });
    
    $('#itemnumber__create').keypress(function(e)
    {
       if(e.which == 13) e.preventDefault();
       
    });
    
    $(document).on('click', '#button__return', function() {
        
        //Get values
        var username = $('#username__return').val();
        var item = $('#item__return').val();
        var quantity = $('#quantity__return').val();
        
        if (username == "" || item == "" || quantity == "")
        {
            notification('Udfyld alle felterne', 'error');
        }
        else
        {
            if ($(this).hasClass('return__sub'))
            {
                url = '../../resources/utilities/employee__handler.php';
            }
            else
            {
                url = '../resources/utilities/employee__handler.php';
            }
            
            //Assign data for Ajax
            post_data = {username: username, item: item, quantity: quantity, task: 'return__item'};
            
            $.post(url, post_data, function(return__code) {
               
                if (return__code == 3)
                {
                    notification('Brugeren findes ikke', 'error');
                }
                else if(return__code == 4)
                {
                    notification('Varen findes ikke', 'error');
                }
                else if (return__code == 5)
                {
                    notification('Brugeren har ikke lånt så mange', 'error');
                }
                else if (return__code == 6)
                {
                    close__modal('return__modal');
                    notification('Varen blev afleveret', 'success');
                    $('#username__return').val('');
                    $('#item__return').val('');
                    $('#quantity__return').val('');
                }
                else if (return__code == 7)
                {
                    notification('Lånet findes ikke', 'error');
                }
                else
                {
                    notification('Der skete en fejl', 'error');
                }
            });
        }
        return false;
        
    });
    
    $(document).on('click', '#button__loan', function() {
       
        //Get values
        var username = $('#username__loan').val();
        var item = $('#item__loan').val();
        var quantity = $('#quantity__loan').val();
        
        //Check that no fields are left empty
        if (username == "" || item == "" || quantity == "")
        {
            notification('Udfyld alle felterne', 'error');
        }
        //Check if the loan is permanent or temporary
        else if ($('#bool__loan').is(':checked'))
        {   
            if ($(this).hasClass('loan__sub'))
            {
                url = '../../resources/utilities/employee__handler.php';
            }
            else
            {
                url = '../resources/utilities/employee__handler.php';
            }
            
            //Assign data for ajax
            post_data = {username: username, item: item, quantity: quantity, task: 'create__permanent'};
            
            $.post(url, post_data, function(loan__result) {
                
                if(loan__result == 3)
                {
                    notification('Brugeren findes ikke', 'error');
                }
                else if(loan__result == 4)
                {
                    notification('Varen er ikke tilgængelig', 'error');
                }
                else if(loan__result == 5)
                {
                    close__modal("loan__modal");
                    notification('Brugerens lånte antal opdateret', 'success');
                }
                else if(loan__result == 6)
                {
                    close__modal("loan__modal");
                    notification('Permanent lån oprettet', 'success');
                }
                else
                {
                    notification('Der skete en fejl', 'error');
                }
                
            });
            
        }
        else
        {   
            date = $('#date__loan').val();
            
            //Create a new date for today
            var today = new Date();
            
            if (date == "")
            {
                notification('Datoen skal udfyldes', 'error');
            }
            //Check that the expiration date is AFTER today
            else if (new Date(date) < today)
            {
                notification('Datoen skal være efter idag', 'error');
            }
            else
            {
                if ($(this).hasClass('loan__sub'))
                {
                    url = '../../resources/utilities/employee__handler.php';
                }
                else
                {
                    url = '../resources/utilities/employee__handler.php';
                }
                
                //Assign data for ajax
                post_data = {username: username, item: item, date: date, quantity: quantity, task: 'create__temporary'};
            
                $.post(url, post_data, function(loan__result) {

                    if (loan__result == 1)
                    {
                        notification('Varen blev udlånt korrekt', 'success');
                    }
                    else if(loan__result == 3)
                    {
                        notification('Brugeren findes ikke', 'error');
                    }
                    else if(loan__result == 4)
                    {
                        notification('Varen er ikke tilgængelig', 'error');
                    }
                    else if(loan__result == 5)
                    {
                        close__modal("loan__modal");
                        notification('Brugerens lånte antal opdateret', 'success');
                    }
                    else if(loan__result == 6)
                    {
                        close__modal("loan__modal");
                        notification('Lån oprettet', 'success');
                    }
                    else
                    {
                        notification('Der skete en fejl', 'error');
                    }

                });
            }
            
            
        }
        
        return false;
        
        
    });
    
    /* ==========================================================================
                            Create user/item click handlers
       ========================================================================== */
    
    $(document).on('click', '#button__create__customer', function() {
        
        //Get values
        var username = $('#username__customer').val();
        var name = $('#name__customer').val();
        var mail = $('#email__customer').val();
        var telephone = $('#telephone__customer').val();
        var type = $('#type__customer').val();
        
        if (username == "" || name == "" || mail == "" || telephone == "" || type == "")
        {
            notification('Udfyld alle felterne', 'error');
        }
        else if(emailValidation(mail))
        {
            if($(this).hasClass('sub__customer'))
            {
                url = '../../resources/utilities/employee__handler.php';
            }
            else
            {
                url = '../resources/utilities/employee__handler.php';
            }
            
            //Assign post data
            post_data = {username: username, name: name, mail: mail, telephone: telephone, type: type, task: 'create__customer'};
            
            $.post(url, post_data, function(creation__code) {
               
                if (creation__code == 1)
                {
                    close__modal('customer__modal');
                    notification('Kunde oprettet', 'success');
                    $('#username__customer').val('');
                    $('#name__customer').val('');
                    $('#email__customer').val('');
                    $('#telephone__customer').val('');
                    $('#type__customer').val('');  
                }
                else if(creation__code == 2)
                {
                    notification('Brugeren findes allerede', 'error');
                }
                else
                {
                    notification('Der skete en fejl', 'error');
                }
                
            });
        }
        else
        {
            notification('Indtast en gyldig mail', 'error');
            $('#email__customer').val("").focus();  
        }
        
        return false;
        
    });
    
    $(document).on('click', '#button__create__item', function() {
        
        //Get values
        var item__number = $('#itemnumber__create').val();
        var item__name = $('#itemname__create').val();
        var category = $('#category__create').val();
        var subcategory = $('#subcategory__create').val();
        var description = $('#description__create').val();
        var place = $('#place__create').val();
        var quantity = $('#quantity__create').val();
        
        if (item__number == "" || item__name == "" || category == "" || place == "" || quantity == "")
        {
            notification('Udfyld alle felterne', 'error');
        }
        else
        {
            if($(this).hasClass('sub__item'))
            {
                url = '../../resources/utilities/employee__handler.php';
            }
            else
            {
                url = '../resources/utilities/employee__handler.php';
            }
            
            //Assign data for ajax
            post_data = {item__number: item__number, item__name: item__name, category: category, subcategory: subcategory, description: description, place: place, quantity: quantity, task: 'create__item'};
            
            $.post(url, post_data, function(create__code) {
                
                if(create__code == 1)
                {
                    close__modal('item__modal');
                    notification('Vare oprettet', 'success');
                    $('#itemnumber__create').val('');
                    $('#itemname__create').val('');
                    $('#category__create').val('');
                    $('#subcategory__create').val('');
                    $('#description__create').val('');
                    $('#place__create').val('');
                    $('#quantity__create').val('');
                }
                else if(create__code == 2)
                {
                    notification('Varenummer findes allerede', 'error');
                }
                else
                {
                    notification('Der skete en fejl', 'error');
                }
                
            });
        }
        
        return false;
        
    });
    
    
    /* ==========================================================================
                            Table row onclick handler
       ========================================================================== */
    
   $(document).on('click', '.user__link', function() {
      
       var user__link = $(this).attr('data-userid');
       
       window.location.href = '../user/' + user__link;
       
   });
   
});

/* ==========================================================================
                            Warehouse scrolling
   ========================================================================== */

/**
 * Settings
 * @watchdog {number} = Counts amount of items that's been showed when scrolling down.
 * @scrollLoad {boolean} = Must be false when page is loaded.
 * @amount {number} = Amount of items that should be called for each call.
 */
var watchdog = 0;
var amount = 20;
var scroll__state = true;

/**
 * List warehouse items
 * @param watchdog
 */
function list__items(watchdog) {

    if (watchdog == 1) {
        watchdog += -1;
    }

    if (scroll__state == true) {
        $.post('../resources/content__loaders/warehouse__item__table.php', {
                amount: amount,
                watchdog: watchdog,
                task: "list__items"
            },
            function (data) {
                $('.no__results').remove();
                $(data).appendTo("#table__warehouse__items");
            });
    }
}

//Show list on page load.
if (window.location.href.indexOf("/lager/") > -1) {
    list__items(watchdog += amount);
}

/* ==========================================================================
                            Searching
   ========================================================================== */

/**
 * Search for an item/items in warehouse
 */
function search__warehouse__items() {

    var search__key = $('#search__text').val();

    $.post('../resources/utilities/search.php', {
            search__key: search__key,
            task: "search__warehouse__items"
        },
        function (data) {
            $('tbody tr').remove();
            $('.no__results').remove();
            $(data).appendTo("#table__warehouse__items");
        });
}

/* ==========================================================================
                        Search Keydown Handler
   ========================================================================== */


//Initiate timer and set interval to half a second
var typing__timer;
var typing__interval = 500;

/**
 * On Keydown handler for search input field
 */
$(document).on('keydown', '#search__text', function () {

    //Clear the timer every time a button is pressed
    clearTimeout(typing__timer);

    //Start the timer back up from the beginning
    typing__timer = setTimeout(function () {

        search__warehouse__items();

    }, typing__interval);

});

 /* ==========================================================================
                                Modal Boxes
    ========================================================================== */

    /**
     * Function that opens modal boxes based on the ID
     * @param {type} target__id     //ID of the modal div to be opened
     * @returns {undefined}
     * Used by = {
     *              /sub__pages/ff__admin.php
     *           }
     */
    function open__modal(target__id)
    {   
        //Select the modal div
        var target = document.querySelector('#' + target__id);

        //Add active class to show the Modal
        castle.add(target, 'modal__active');

    }

    /**
     * Function that closes modal boxes based on ID 
     * @param {type} target__id     //ID of the modal div to be closed
     * @returns {undefined}
     * Used by = {
     *              /sub__pages/ff__admin.php
     *           }
     */
    function close__modal(target__id)
    {
        //Select the modal div
        var target = document.querySelector('#' + target__id);

        //Remove active class to hide Modal
        castle.remove(target, 'modal__active');

    }

/* ==========================================================================
                            Notification Function
   ========================================================================== */

    /**
     * 
     * @param {type} notification       //Notification to be output on page
     * @param {type} type               //Type of notification - Success or Error
     * @returns {undefined}
     * Used by = {
     *              /sub__pages/ff.php
     *              /sub__pages/ff__history.php
     *              /sub__pages/ff__admin.php
     *           }
     */
    function notification(notification, type)
    {
        //Insert the notification in the notification div
        $('.notification__text').text(notification);

        if (type == 'success')
        {
            //add success class to change notification color
            $('.notification__inwrap').addClass('success');
        }
        else
        {
            //add error class to change notification color
            $('.notification__inwrap').addClass('error');
        }

        //add active class to div that times out after a few seconds.
        $('.notification__inwrap').addClass('active');

        //Set 5 second timer and remove the notification again
        setTimeout(function() {

            $('.notification__inwrap').removeClass('active');
            $('.notification__text').text('');

            //Remove both classes just in case
            $('.notification__inwrap').removeClass('error');
            $('.notification__inwrap').removeClass('success');

        }, 5000);
    }
    
    /* ==========================================================================
                            Email validation
   ========================================================================== */
    
    function emailValidation(email) 
    {
        var regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

        return regEx.test(email);
    }

/* ==========================================================================
                            Class Helper
   ========================================================================== */

(function(window)
{

    'use strict';

    function classReg(className) 
    {
        return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
    }

    var hasClass, addClass, removeClass;

    if ( 'classList' in document.documentElement ) 
    {
        hasClass = function(elem, c) 
        {
            return elem.classList.contains(c);
        };
        
        addClass = function(elem, c) 
        {
            elem.classList.add(c);
        };
        
        removeClass = function(elem, c) 
        {
            elem.classList.remove(c);
        };
    }
    else 
    {
        hasClass = function(elem, c) {
            return classReg(c).test(elem.className);
        };
        
        addClass = function(elem, c) 
        {
            if (!hasClass(elem, c)) 
            {
                elem.className = elem.className + ' ' + c;
            }
        };
        
        removeClass = function(elem, c) 
        {
            elem.className = elem.className.replace(classReg(c), ' ');
        };
    }

    function toggleClass(elem, c) 
    {
        var fn = hasClass(elem, c) ? removeClass : addClass;
        fn(elem, c);
    }

    var castle = 
    {
      // full names
      hasClass: hasClass,
      addClass: addClass,
      removeClass: removeClass,
      toggleClass: toggleClass,
      // short names
      has: hasClass,
      add: addClass,
      remove: removeClass,
      toggle: toggleClass
    };

    // transport
    if(typeof define === 'function' && define.amd) 
    {
      // AMD
      define(castle);
    } 
    else 
    {
      // browser global
      window.castle = castle;
    }

})( window );