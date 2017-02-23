<?php 
    
    //Start session
    session_start();
    
    //Check for session
    if (!$_SESSION['user__id']):
    
?>

<!DOCTYPE html>
<html>
    
    <head>
        
        <!-- Meta Data -->
        <title>Login | SKP Systems</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="resources/images/favicon.ico"/>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600" rel="stylesheet">
        
        <!-- Style sheets -->
        <link rel="stylesheet" type="text/css" href="resources/stylesheets/application-71f56208694c67f067f1878a3df1f5ba7c941935.css">
        
        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="resources/scripts/application-045795a69dcae969289cc03ac04c9f4154b468ca.js" defer></script>
        
    </head>
    
    <body>
        
        <div class="page__container">
            
            <!-- Main Content Container for Sign In Form -->
            
            <div class="main__content" id="sign__in">
                
                <!-- Form container -->
    
                <div class="form">
        
                    <div class="form__content">
                        
                        <!-- Container for login alerts (If user fails to sign in correctly) -->
            
                        <div class="form__alert">
                
                            <div class="alert"></div>
                
                        </div>
                        
                        <!-- Form title -->
                        
                        <div class="form__title">SKP Systems</div>
                        
                        <!-- Sign in form -->
            
                        <form id="user__entry" class="simple__form" action="./" method="post" accept-charset="UTF-8" novalidate="novalidate" autocomplete="off">
                
                            <!-- Form Input container -->
                            
                            <div class="form__input">
                                
                                <!-- Input for username -->
                    
                                <div class="form__item username">
                        
                                    <input type="text" id="username__entry" name="username" class="form__control" autofocus="autofocus" required autocomplete="off" placeholder="Username" value="" />
                        
                                </div>
                                
                                <!-- Input for password -->
                    
                                <div class="form__item password">
                        
                                    <input type="password" id="password__entry" name="password" class="form__control" required autocomplete="off" placeholder="Password" value="" />
                        
                                </div>
                    
                            </div>
                            
                            <!-- Form buttons container -->
                
                            <div class="form__buttons">
                                    
                                <!-- Link to FF timer as not signed in - Meant for students to see their hours -->
                                
                                <a class='button form__button button__blue' href='../ff/'>Se Ferie/Fri</a>
                                
                                <!-- Sign in submit button -->
                                
                                <button id="login__button" class="button form__button button__red">Log ind</button>
                    
                            </div>
                
                        </form>
            
                    </div>
        
                </div>
    
            </div>
            
        </div>
        
    </body>
    
</html>

    
    <?php else:
        
        //Redirect to lager if user is of type - Lager
        if($_SESSION['user__type'] == 'lager')
        {
            header("Location: lager/");
        }
        //Redirect to ff as only remaining option is admin
        else
        {
            header("Location: ff/");
        }
 
    endif; ?>
