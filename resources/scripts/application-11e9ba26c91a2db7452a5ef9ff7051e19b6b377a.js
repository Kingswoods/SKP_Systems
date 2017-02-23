/**
 * 
 * Javascript file for SKP Systems
 * Used by /sub__pages/schedule.php
 * Used by /sub__pages/schedule__admin.php
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
                    Initialize Dropdown and Load Schedule
   ========================================================================== */

$(document).ready(function() {
   
    $('select').castle__select();
    
    $(document).on('change', '#week__dropdown', function() {
       
        show__week($(this).val())
        
    });
    
    var default__week = $('#week__dropdown').val();
    
    show__week(default__week);
    
    $(".list").mCustomScrollbar({
            theme: "minimal-dark",
            scrollInertia: "100"
        });
    
    schedule__colors();
    
    /* ==========================================================================
                          Schedule Autocomplete Handler
       ========================================================================== */
    
    /**
     * Auto complete weeks for employee
     * Handler that triggers auto complete
     */

    $(document).on('click', '#autocomplete__week__submit', function () {

        var employee = $("#employee__dropdown").val(); // Employee

        var weeks = $("#weeks__input").val(); // Weeks

        var year = $("#year__dropdown").val(); // Year

        var role = $("#role__input").val(); // Role

        autocomplete__schedule(employee, year, weeks, role);

    });
    
    /* ==========================================================================
                               Focusout Handler
       ========================================================================== */
    
    $(document).on('focusout', '#schedule__input', function () 
    {
        if($(this).val() == "")
        {
            //Do Nothing
            return false;
        }
        else
        {
            var schedule__data = $(this).data("id__date") + "|" + $(this).val(); // (id|date|role) Example: 1|2017-02-16|SKP

            update__schedule(schedule__data);

            // If input value contains only space
            if ($(this).val() == " ") 
            {
                $(this).val("");
            }
        }
        
    });
    
});

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
                                Schedule Functions
   ========================================================================== */
    
function show__week(week__number)
{   
    post_data = {date: week__number, task: 'show__week'};

    $.post('../resources/utilities/employee__handler.php', post_data, function(data) {

        $('.schedule').remove();

        $('.content__title__week').remove();

        $(data).appendTo('#schedule__panel');         

        $('.content__title').append($('.content__title__week'));

        schedule__colors();

    });

    return false;
}
    
function update__schedule(schedule__data) 
{
    //Assign post data for Ajax
    post_data = {schedule__data: schedule__data, task: 'update__schedule'};

    $.post('../resources/utilities/employee__handler.php', post_data, function(result) {

        if (result == 1)
        {
            notification('Ændringerne blev gemt', 'success');
        }
        else
        {
            notification('Der skete en fejl', 'error');
        }

    });

    return false;

}
    
/*
 * Auto complete weeks for employee
 * @param employee
 * @param year
 * @param weeks
 * @param role
 * @returns {boolean}
 */
function autocomplete__schedule(employee, year, weeks, role)
{
    //Assign data for Ajax'
    post_data = {employee__id: employee, weeks: weeks, year: year, employee__role: role, task: 'autocomplete__schedule'};

    $.post('../resources/utilities/employee__handler.php', post_data, function(result) {

        if (result == 1)
        {
            notification('Ændringerne blev gemt', 'success');
        }
        else
        {
            notification('Der skete en fejl', 'error');
        }

    });
    return false;

}
    
function schedule__colors() 
{
    var inputs = $('input[name=schedule__input__color]');

    for (var i = 0; i < inputs.length; i++) {

        inputs[i].value = inputs[i].value.toUpperCase();

        if (inputs[i].value == "") {
            inputs[i].style.backgroundColor = "";
        } else if (inputs[i].value == "SKP" || inputs[i].value.indexOf("SKP") > -1) {
            inputs[i].style.backgroundColor = "#ffe600";
            inputs[i].style.color = "#000000";
        } else if (inputs[i].value == "FERIE" || inputs[i].value.indexOf("FERIE") > -1) {
            inputs[i].style.backgroundColor = "#FF9900";
            inputs[i].style.color = "#000000";
        } else if (inputs[i].value == "FF" || inputs[i].value.indexOf("FF") > -1) {
            inputs[i].style.backgroundColor = "#FF9900";
            inputs[i].style.color = "#000000";
        } else if (inputs[i].value == "HF" || inputs[i].value.indexOf("HF") > -1) {
            inputs[i].style.backgroundColor = "#0096ff";
            inputs[i].style.color = "#000000";
        } else if (inputs[i].value == "VFU" || inputs[i].value.indexOf("VFU") > -1) {
            inputs[i].style.backgroundColor = "#00ff19";
            inputs[i].style.color = "#000000";
        } else if (inputs[i].value == "PROJEKT" || inputs[i].value.indexOf("PROJEKT") > -1) {
            inputs[i].style.backgroundColor = "#a80bba";
            inputs[i].style.color = "#000000";
        } else if (inputs[i].value == "SYG" || inputs[i].value.indexOf("SYG") > -1) {
            inputs[i].style.backgroundColor = "#ff4d4d";
            inputs[i].style.color = "#000000";
        } else if (inputs[i].value == "STOP" || inputs[i].value.indexOf("STOP") > -1) {
            inputs[i].style.backgroundColor = "#a0a0a0";
            inputs[i].style.color = "#000000";
        } else if (inputs[i].value == " " || inputs[i].value.indexOf("SKP") > -1) {
            inputs[i].style.backgroundColor = "";
        } else {
            inputs[i].style.backgroundColor = "#23222d";
            inputs[i].style.color = "#ffffff";
        }
    }

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
                                    Dropdown
   ========================================================================== */

   (function($) {

      $.fn.castle__select = function(method) {

        // Methods
        if (typeof method == 'string') {      
          if (method == 'update') {
            this.each(function() {
              var $select = $(this);
              var $dropdown = $(this).next('.castle__select');
              var open = $dropdown.hasClass('open');

              if ($dropdown.length) {
                $dropdown.remove();
                create_nice_select($select);

                if (open) {
                  $select.next().trigger('click');
                }
              }
            });
          } else if (method == 'destroy') {
            this.each(function() {
              var $select = $(this);
              var $dropdown = $(this).next('.castle__select');

              if ($dropdown.length) {
                $dropdown.remove();
                $select.css('display', '');
              }
            });
            if ($('.castle__select').length == 0) {
              $(document).off('.castle_select');
            }
          } else {
            console.log('Method "' + method + '" does not exist.')
          }
          return this;
        }

        // Hide native select
        this.hide();

        // Create custom markup
        this.each(function() {
          var $select = $(this);

          if (!$select.next().hasClass('castle__select')) {
            create__castle__select($select);
          }
        });

        function create__castle__select($select) {
          $select.after($('<div></div>')
            .addClass('castle__select')
            .addClass($select.attr('class') || '')
            .addClass($select.attr('disabled') ? 'disabled' : '')
            .attr('tabindex', $select.attr('disabled') ? null : '0')
            .html('<span class="current"></span><ul class="list"></ul>')
          );

          var $dropdown = $select.next();
          var $options = $select.find('option');
          var $selected = $select.find('option:selected');

          $dropdown.find('.current').html($selected.data('display') || $selected.text());

          $options.each(function(i) {
            var $option = $(this);
            var display = $option.data('display');

            $dropdown.find('ul').append($('<li></li>')
              .attr('data-value', $option.val())
              .attr('data-display', (display || null))
              .addClass('option' +
                ($option.is(':selected') ? ' selected' : '') +
                ($option.is(':disabled') ? ' disabled' : ''))
              .html($option.text())
            );
          });
        }

        /* Event listeners */

        // Unbind existing events in case that the plugin has been initialized before
        $(document).off('.castle_select');

        // Open/close
        $(document).on('click.castle_select', '.castle__select', function(event) {
          var $dropdown = $(this);

          $('.castle__select').not($dropdown).removeClass('open');
          $dropdown.toggleClass('open');

          if ($dropdown.hasClass('open')) {
            $dropdown.find('.option');  
            $dropdown.find('.focus').removeClass('focus');
            $dropdown.find('.selected').addClass('focus');
          } else {
            $dropdown.focus();
          }
        });

        // Close when clicking outside
        $(document).on('click.castle_select', function(event) {
          if ($(event.target).closest('.castle__select').length === 0) {
            $('.castle__select').removeClass('open').find('.option');  
          }
        });

        // Option click
        $(document).on('click.castle_select', '.castle__select .option:not(.disabled)', function(event) {
          var $option = $(this);
          var $dropdown = $option.closest('.castle__select');

          $dropdown.find('.selected').removeClass('selected');
          $option.addClass('selected');

          var text = $option.data('display') || $option.text();
          $dropdown.find('.current').text(text);

          $dropdown.prev('select').val($option.data('value')).trigger('change');
        });

        // Keyboard events
        $(document).on('keydown.castle_select', '.castle__select', function(event) {    
          var $dropdown = $(this);
          var $focused_option = $($dropdown.find('.focus') || $dropdown.find('.list .option.selected'));

          // Space or Enter
          if (event.keyCode == 32 || event.keyCode == 13) {
            if ($dropdown.hasClass('open')) {
              $focused_option.trigger('click');
            } else {
              $dropdown.trigger('click');
            }
            return false;
          // Down
          } else if (event.keyCode == 40) {
            if (!$dropdown.hasClass('open')) {
              $dropdown.trigger('click');
            } else {
              var $next = $focused_option.nextAll('.option:not(.disabled)').first();
              if ($next.length > 0) {
                $dropdown.find('.focus').removeClass('focus');
                $next.addClass('focus');
              }
            }
            return false;
          // Up
          } else if (event.keyCode == 38) {
            if (!$dropdown.hasClass('open')) {
              $dropdown.trigger('click');
            } else {
              var $prev = $focused_option.prevAll('.option:not(.disabled)').first();
              if ($prev.length > 0) {
                $dropdown.find('.focus').removeClass('focus');
                $prev.addClass('focus');
              }
            }
            return false;
          // Esc
          } else if (event.keyCode == 27) {
            if ($dropdown.hasClass('open')) {
              $dropdown.trigger('click');
            }
          // Tab
          } else if (event.keyCode == 9) {
            if ($dropdown.hasClass('open')) {
              return false;
            }
          }
        });

        // Detect CSS pointer-events support, for IE <= 10. From Modernizr.
        var style = document.createElement('a').style;
        style.cssText = 'pointer-events:auto';
        if (style.pointerEvents !== 'auto') {
          $('html').addClass('no-csspointerevents');
        }

        return this;

      };

    }(jQuery));

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

        search__schedule();

    }, typing__interval);

});

/**
 * Search for an employee in schedule
 */
function search__schedule() {

    var search__key = $('#search__text').val();

    var date = $('#week__dropdown').val();

    $.post('../resources/utilities/search.php', {
            search__key: search__key,
            date: date,
            task: "search__schedule__employees"
        },
        function (data) {
            $('tbody tr').remove();
            $(data).appendTo("#schedule__table");
            schedule__colors();
        });
}