<!-- Modal to edit information and privileges of admin and lager users -->

<div class="modal modal__effect__1" id="edit__modal">
    
    <!-- Pop up box content -->

    <div class="modal__content">

        <div class="modal__title">Rediger Bruger</div>
        
        <!-- Container with edit form -->

        <div class="modal__text">
            
            <form id="edit__entry" class="simple__form" action="./" method="post" accept-charset="UTF-8" novalidate="novalidate" autocomplete="off">
                
                <div class="form__input">
                    
                    <div class="form__item username">
                        
                        <input type="text" id="username__edit" name="username" class="form__control" autofocus="autofocus" required autocomplete="off" placeholder="Brugernavn" value="" readonly />
                        
                    </div>
                    
                    <div class="form__item password">
                        
                        <input type="password" id="password__edit" name="password" class="form__control" required autocomplete="off" placeholder="Password" value="" />
                        
                    </div>
                    
                    <span class="info">Udfyld kun hvis password skal skiftes</span>
                    
                    <div class="form__item description">
                        
                        <input type="text" id="description__edit" name="description" class="form__control" required autocomplete="off" placeholder="Beskrivelse" value="" />
                        
                    </div>
                    
                    <div class="form__item type">
                        
                        <input type="text" id="type__edit" name="privilege" class="form__control" required autocomplete="off" placeholder="Type: Admin eller Lager" value="" />
                        
                    </div>
                    
                </div>
                
                <!-- Modal cancel and edit buttons -->
                
                 <div class='modal__buttons'>

                    <a class='button square__button modal__button button__cancel button__red'>Cancel</a>
                    <button id='button__edit' class='button square__button modal__button button__green'>Rediger</button>

                </div>
                
            </form>

        </div>

    </div>

</div>