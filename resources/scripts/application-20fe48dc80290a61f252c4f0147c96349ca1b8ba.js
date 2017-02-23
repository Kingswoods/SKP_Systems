/**
 * 
 * Javascript file for SKP Systems
 * Used by sub__pages/ff.php
 * Used by sub__pages/ff__admin.php
 * Used by sub__pages/ff__history.php
 * 
 */

/* ==========================================================================
                          Initialize Scrollbars
   ========================================================================== */

//Initialize custom scrollbar on main content
(function($){
    $(window).on("load",function(){
        $(".main__content").mCustomScrollbar({
            theme: "minimal-dark",
            scrollInertia: "300"
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
                            On Click Handlers
   ========================================================================== */

$(document).ready(function () {
    
    /* ==========================================================================
                                Modal Triggers
       ========================================================================== */
    
    /**
     * On Click Handler for updating employees in the database
     * Used by = {
     *              /sub__pages/ff__admin.php
     *           }
     */
    $(document).on('click', '#update__employees', function() {
        
        //Set data-attribute on modal overlay
        $('.modal__overlay').attr('data-modal', "confirm__modal");
        
        //Set data-attribute on modal close
        $('.button__cancel').attr('data-modal', "confirm__modal");
        
        //Set modal warning text
        $('#confirm__text').text('Er du sikker på, at du vil opdatere listen med elever?');
        
        //Set data-attribute on confirm button
        $('.button__confirm').attr('data-task', "update__employees");
        
        //Open modal box
        open__modal('confirm__modal');
        
    });
    
    /**
     * On Click Handler for creating an admin/lager user
     * Used by = {
     *              /sub__pages/ff__admin.php
     *           }
     */
    $(document).on('click', '#create__user', function() {
        
        //Set data-attribute on modal overlay
        $('.modal__overlay').attr('data-modal', "create__modal");
        
        //Set data-attribute on modal close
        $('.button__cancel').attr('data-modal', "create__modal");
        
        //Open modal box
        open__modal('create__modal');
        
        setTimeout(function() {

            $('#username__create').focus();
            
        }, 500);
        
    });
    
    /**
     * On Click Handler for editing an admin/lager user
     * Used by = {
     *              /sub__pages/ff__admin.php
     *           }
     */
    $(document).on('click', '.edit', function() {
        
        //Set data-attribute on modal overlay
        $('.modal__overlay').attr('data-modal', "edit__modal");
        
        //Set data-attribute on modal close
        $('.button__cancel').attr('data-modal', "edit__modal");
        
        //Set data-attribute on confirm button
        $('.button__confirm').attr('data-task', "edit__user");
        
        //Set target data-attribute
        $('.button__edit').attr('data-id', $(this).data('userid'));
        
        //Get current user values
        var username = $(this).parent().parent().find('.table__username').text();
        var description = $(this).parent().parent().find('.table__description').text();
        var privilege = $(this).parent().parent().find('.privilege').text();
        
        //Set input values
        $('#username__edit').val(username);
        $('#description__edit').val(description);
        $('#type__edit').val(privilege);
        
        //Open modal box
        open__modal('edit__modal');
        
    });
    
    /**
     * On Click Handler for deleting an admin/lager user
     * Used by = {
     *              /sub__pages/ff__admin.php
     *           }
     */
    $(document).on('click', '.delete', function() {
       
        //Get the target user - This is disgusting
        var target = $(this).parent().siblings().first().text();
        
        //Set modal warning text
        $('#confirm__text').html('Er du sikker på, at du vil slette <span class="bold">' + target + '</span>');
        
        //Set data-attribute on modal overlay
        $('.modal__overlay').attr('data-modal', "confirm__modal");
        
        //Set data-attribute on modal close
        $('.button__cancel').attr('data-modal', "confirm__modal");
        
        //Set data-attribute on confirm button
        $('.button__confirm').attr('data-task', "delete__user");
        
        //Set target data-attribute
        $('.button__confirm').attr('data-id', $(this).data('userid'));
        
        //Open modal box
        open__modal('confirm__modal');
        
    });
    
    /**
     * On Click Handler for hiding FF Employees - They will be set as inactive and placed in the inactive table instead
     * Used by = {
     *              /sub__pages/ff.php
     *           }
     */
    $(document).on('click', '.hide', function() {
       
        //Get the target user - This is disgusting
        var target = $(this).parent().siblings().first().text();
        
        //Set modal warning text
        $('#confirm__text').html('Er du sikker på, at du vil sætte <span class="bold">' + target + '</span> som inaktiv?');
        
        //Set data-attribute on modal overlay
        $('.modal__overlay').attr('data-modal', "confirm__modal");
        
        //Set data-attribute on modal close
        $('.button__cancel').attr('data-modal', "confirm__modal");
        
        //Set data-attribute on confirm button
        $('.button__confirm').attr('data-task', "hide__user");
        
        //Set target data-attribute
        $('.button__confirm').attr('data-id', $(this).data('userid'));
        
        //Open modal box
        open__modal('confirm__modal');
        
    });
    
    /**
     * On Click Handler for showing FF Employees - Inactive users will be set back as active
     */
    $(document).on('click', '.show', function() {
        
        //Get the target user - This is disgusting
        var target = $(this).parent().siblings().first().text();
        
        //Set modal warning text
        $('#confirm__text').html('Er du sikker på, at du vil sætte <span class="bold">' + target + '</span> som aktiv?');
        
        //Set data-attribute on modal overlay
        $('.modal__overlay').attr('data-modal', "confirm__modal");
        
        //Set data-attribute on modal close
        $('.button__cancel').attr('data-modal', "confirm__modal");
       
        //Set data-attribute on confirm button
        $('.button__confirm').attr('data-task', "show__user");
        
        //Set target data-attribute
        $('.button__confirm').attr('data-id', $(this).data('userid'));
        
        //Open modal box
        open__modal('confirm__modal');
        
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
    
    /* ==========================================================================
                            Edit User Modal Buttons
       ========================================================================== */
    
    $(document).on('click', '#button__edit', function() {
       
        //Get the input field values
        var username = $('#username__edit').val();
        var password = $('#password__edit').val();
        var description = $('#description__edit').val();
        var privilege = $('#type__edit').val();
        
        if (username == "" || description == "" || privilege == "")
        {
            notification('Udfyld alle felterne', 'error');
        }
        else if(privilege.toLowerCase() != 'admin' && privilege.toLowerCase() != 'lager')
        {
            notification('Type skal være admin eller lager', 'error');
        }
        else
        {
            //Assign data for Ajax
            post_data = {username: username, password: password, description: description, privilege: privilege, task: 'edit__user'};
            
            $.post('../../resources/utilities/admin__handler.php', post_data, function(edit__code) {
                
                if (edit__code == 1)
                {
                    //Close the modal box
                    close__modal("edit__modal");

                    //Reset form values
                    $('#username__edit').val("");
                    $('#password__edit').val("");
                    $('#description__edit').val("");
                    $('#type__edit').val("");

                    //Output updated values on page
                    $(".table__username[data-username='" + username + "']").text(username);
                    $(".table__description[data-username='" + username + "']").text(description);
                    $(".privilege[data-username='" + username + "']").text(privilege);

                    notification('Brugeren blev rettet korrekt', 'success');
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
                            Create User Modal Buttons
       ========================================================================== */
    
    $(document).on('click', '#button__register', function() {
       
        //Get the input field values
        var username = $('#username__create').val();
        var password = $('#password__create').val();
        var description = $('#description__create').val();
        var privilege = $('#type__create').val();
        
        if (username == "" || password == "" || description == "" || privilege == "")
        {
            notification('Udfyld alle felterne', 'error');
        }
        else if(privilege.toLowerCase() != 'admin' && privilege.toLowerCase() != 'lager')
        {
            notification('Type skal være admin eller lager', 'error');
        }
        else
        {
            //Assign data for Ajax
            post_data = {username: username, password: password, description: description, privilege: privilege, task: 'create__user'};
            
            $.post('../../resources/utilities/admin__handler.php', post_data, function(data) {
                
                //Close the modal box
                close__modal("create__modal");
               
                //Reset form values
                $('#username__create').val("");
                $('#password__create').val("");
                $('#description__create').val("");
                $('#type__create').val("");
                
                //Append the new user
                $(data).hide().appendTo(".table__users tbody").fadeIn();
                
                notification('Brugeren blev oprettet korrekt', 'success');
                
            });
        }
        
        return false;
        
    });
    
    /* ==========================================================================
                            Confirm Modal Buttons
       ========================================================================== */
       
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
    
    /**
     * On Click Handler for the confirm button in the confirm modal
     * Used by = {
     *              /sub__pages/ff__admin.php
     *           }
     */
    $(document).on('click', '.button__confirm', function() 
    {
        //Close the modal box
        close__modal("confirm__modal");
        
        var task = $(this).attr('data-task');
        
        //Check the data-task value on the confirm button
        if (task == 'update__employees')
        {
            //Assign the task as post data for Ajax
            post_data = {task: task};
            
            //Send task to employee handler which will update the employee list
            $.post('../../resources/utilities/employee__handler.php', post_data, function(update__code){
               
                //If successful
                if (update__code == 1)
                {
                    notification('Eleverne blev opdateret korrekt', 'success');
                }
                //If error
                else
                {
                    notification('Der skete en fejl', 'error');
                }
                
            });
        }
        else if(task == 'delete__user')
        {
            //Get the target from confirm button
            var target = $(this).attr('data-id');
            
            //Assign the task as post data for Ajax
            post_data = {target: target, task: task};
            
            //Send task
            $.post('../../resources/utilities/admin__handler.php', post_data, function(delete__code)
            {
                //If succesful
                if (delete__code == 1)
                {
                    var delete__target = $(".table__users").find('[data-rowid="' + target + '"]');
                    
                    delete__target.remove().fadeOut('slow');
                    
                    notification('Brugeren blev slettet', 'success');
                    
                    $('.button__confirm').attr('data-id', 0)
                }
                else
                {
                    notification('Der skete en fejl', 'error');
                }

            });
        }
        else if(task == 'hide__user')
        {
            //Get the target from confirm button
            var target = $(this).attr('data-id');
            
            //Assign the task as post data for Ajax
            post_data = {target: target, task: task};
            
            $.post('../../resources/utilities/employee__handler.php', post_data, function(hide__code)
            {
                //If succesful
                if(hide__code == 1)
                {
                    var hide__target = $(".table__employees").find('[data-rowid="' + target + '"]');
                    
                    hide__target.remove().fadeOut('slow');
                    
                    notification('Brugeren blev sat til inaktiv', 'success');
                    
                    $('.button__confirm').attr('data-id', 0)
                   
                }
                else
                {
                    notification('Der skete en fejl', 'error');
                }
                
            });
        }
        else if(task == 'show__user')
        {
            //Get the target from confirm button
            var target = $(this).attr('data-id');
            
            //Assign the task as post data for Ajax
            post_data = {target: target, task: task};
            
            $.post('../../../resources/utilities/employee__handler.php', post_data, function(show__code)
            {
                //If succesful
                if(show__code == 1)
                {
                    var show__target = $(".table__inactive").find('[data-rowid="' + target + '"]');
                    
                    show__target.remove().fadeOut('slow');
                    
                    notification('Brugeren blev sat til aktiv', 'success');
                    
                    $('.button__confirm').attr('data-id', 0)
                   
                }
                else
                {
                    notification('Der skete en fejl', 'error');
                }
                
            });
        }
        
    });
    
    /* ==========================================================================
                        Add / Remove X Hours Buttons
       ========================================================================== */
    
    /**
     * On click handler for add hours button
     * Used by = {
     *              /sub__pages/ff.php
     *              /sub__pages/ff__history.php
     *           }
     */
    $(document).on('click', '#add__all', function() {
        
        //Get the value of the input field
        var add__value = $("#add__ff").val();
        
        //Check that it was filled out
        if (add__value != "")
        {
            //Change url based on which page the button is clicked on
            if($(this).hasClass('add__hours'))
            {
                update__all(add__value, '../../resources/utilities/employee__handler.php', 'add__x');
            }
            else
            {
                update__all(add__value, '../resources/utilities/employee__handler.php', 'add__x');
            }
        }
        else
        {
            //Display error if nothing is filled in
            notification('Indtast et antal i feltet', 'error');
        }
        
    });
    
    /**
     * On click handler for remove hours button
     * Used by = {
     *              /sub__pages/ff.php
     *              /sub__pages/ff__history.php
     *           }
     */
    $(document).on('click', '#remove__all', function() {
        
        //Get the value of the input field
        var remove__value = $("#remove__ff").val();
        
        //Check that it was filled out
        if (remove__value != "")
        {
            //Change url based on which page the button is clicked on
            if($(this).hasClass('remove__hours'))
            {
                update__all(remove__value, '../../resources/utilities/employee__handler.php', 'remove__x');
            }
            else
            {
                update__all(remove__value, '../resources/utilities/employee__handler.php', 'remove__x');
            }
           
        }
        else
        {
            //Display error if nothing is filled in
            notification('Indtast et antal i feltet', 'error');
        }
        
    });
    
    /* ==========================================================================
                                Keydown Handler
       ========================================================================== */
    
    //Initiate timer and set interval to half a second
    var typing__timer;
    var typing__interval = 800;
    
    /**
     * On Keydown handler on current__ff input fields
     * Used by = {
     *              /sub__pages/ff.php
     *           }
     */
    $(document).on('keydown', '#current__ff', function() {

        //Get user ID from the changed input
        var user__id = $(this).data('userid');

        //Clear the timer every time a button is pressed
        clearTimeout(typing__timer);
        
        //Start the timer back up from the beginning
        typing__timer = setTimeout(function() 
        {
            //Get the new value from the input field
            var current__ff = $("#current__ff[data-userid='" + user__id + "']").val();
            
            //Call update__user function to update the user
            update__user(user__id, current__ff);
        }, typing__interval);
        
    });
    
});

/* ==========================================================================
                            Functions
   ========================================================================== */

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
                                Update Functions
       ========================================================================== */
    
    /**
     * Function that adds or removes X amount of FF hours to all active users.
     * @param {type} value      //The value to be added or removed
     * @param {type} url        //Url to the employee handler - Due to being run on several pages
     * @param {type} task       //What task to perform - Adding or Removing
     * @returns {undefined}
     * Used by = {
     *              /sub__pages/ff.php
     *              /sub__pages/ff__history.php
     *           }
     */
    function update__all(value, url, task)
    {
        //Assign post data for Ajax.
        post_data = {value: value, task: task};
    
        //Post data to ajax
        $.post(url, post_data, function(update__code) {
        
            if(update__code == 1)
            {
                location.reload();
            }
            else
            {
                notification('Der skete en fejl', 'error');
            }
        
        });
    }
    
    /**
     * Function for updating a single user when a value is changed
     * @param {type} user__id           //User ID of the user whos value was changed
     * @param {type} current__ff        //New value of the current__ff field
     * @returns {undefined}
     * Used by = {
     *              /sub__pages/ff.php
     *           }
     */
    function update__user(user__id, current__ff)
    {
        //Assign post data for ajax
        post_data = {user__id : user__id, current__ff : current__ff, task : 'update__user'};

        //Post data to employee handler via Ajax
        $.post('../resources/utilities/employee__handler.php', post_data, function(update__code) {

            //Get the JSON array from Ajax
            var response = JSON.parse(update__code);

            if(response.update__code == 1)
            {
                //Output updated values on page
                $("#used__ff[data-userid='" + user__id + "']").text(response.new__used);
                $("#total__ff[data-userid='" + user__id + "']").text(response.new__total);

                //Display success notification
                notification('Ændringerne blev gemt', 'success');
            }
            else
            {
                //Display error notification
                notification('Der skete en fejl', 'error');
            }
        });

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

        search__ff();

    }, typing__interval);

});

/**
 * Search for an employee in FF
 */
function search__ff() {

    var search__key = $('#search__text').val();

    $.post('../resources/utilities/search.php', {
            search__key: search__key,
            task: "search__ff__employees"
        },
        function (data) {
            $('tbody tr').remove();
            $(data).appendTo(".table__employees");
        });
}
