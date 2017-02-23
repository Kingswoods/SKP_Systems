/**
 * 
 * Javascript file for SKP Systems
 * Used by index.php
 * 
 */

/* ==========================================================================
                            Login Form Button
   ========================================================================== */
    
    /**
     * On click handler for submit button when signing in
     * Used by = {
     *              index.php
     *           }
     */
    $(document).on('click', '#login__button', function() {
        
        //Get entered values from fields
        var username = $('#username__entry').val();
        var password = $('#password__entry').val();
        
        //Verify that both fields were filled
        if (username == "" || password == "")
        {
            alert("Please fill out all the fields.");
        }
        else
        {
            //Assign post data for ajax
            post_data = {username : username, password : password, task: 'sign__in'};
            
            //Post data to account__handler
            $.post('../resources/utilities/admin__handler.php', post_data, function(login__code) {
                
                if (login__code == 1)
                {
                    window.location = '../';
                }
                else if (login__code == 2)
                {
                    alert("Forkert brugernavn eller kodeord.");
                }
                else
                {
                    alert("Der skete en fejl.");
                }
                    
            });
        }
        
        return false;
    });

/* ==========================================================================
                            Login Alert Function
   ========================================================================== */

    /**
     * Function to output alerts when login fails
     * @param {type} error__message         //Error Message to be displayed on page
     * @return {undefined}
     * Used by = {
     *              index.php
     *           }
     */
    function alert(error__message)
    {
        //Insert the message in the alert div
        $('.alert').text(error__message);

        //Add active class to div that times out after 5 seconds.
        $('.form__alert').addClass('active');

        //Set a 3 second timeout and remove the alert.
        setTimeout(function() {

            $('.form__alert').removeClass('active');
            $('.alert').text('');
        }, 3000);
    }
