<!-- Create user modal to create new admin and lager accounts -->

<div class="modal modal__effect__1" id="create__modal">
    
    <!-- Pop up box content -->

    <div class="modal__content">

        <div class="modal__title">Opret Bruger</div>
        
        <!-- Container with registration form -->

        <div class="modal__text">
            
            <form id="create__entry" class="simple__form" action="./" method="post" accept-charset="UTF-8" novalidate="novalidate" autocomplete="off">
                
                <div class="form__input">
                    
                    <div class="form__item username">
                        
                        <input type="text" id="username__create" name="username" class="form__control" autofocus="autofocus" required autocomplete="off" placeholder="Brugernavn" value="" />
                        
                    </div>
                    
                    <div class="form__item password">
                        
                        <input type="password" id="password__create" name="password" class="form__control" required autocomplete="off" placeholder="Password" value="" />
                        
                    </div>
                    
                    <div class="form__item description">
                        
                        <input type="text" id="description__create" name="description" class="form__control" required autocomplete="off" placeholder="Beskrivelse" value="" />
                        
                    </div>
                    
                    <div class="form__item type">
                        
                        <input type="text" id="type__create" name="privilege" class="form__control" required autocomplete="off" placeholder="Type: Admin eller Lager" value="" />
                        
                    </div>
                    
                </div>
                
                <!-- Modal cancel and create buttons -->
                
                <div class='modal__buttons'>

                    <a class='button square__button modal__button button__cancel button__red'>Cancel</a>
                    <button id='button__register' class='button square__button modal__button button__green'>Create</button>

                </div>
                
            </form>

        </div>

    </div>

</div>