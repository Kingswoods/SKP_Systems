<!-- Create user modal to create new customers -->

<div class="modal modal__effect__1" id="customer__modal">
    
    <!-- Pop up box content -->

    <div class="modal__content">

        <div class="modal__title">Opret Kunde</div>
        
        <!-- Container with registration form -->

        <div class="modal__text">
            
            <form id="create__entry" class="simple__form" action="./" method="post" accept-charset="UTF-8" novalidate="novalidate" autocomplete="off">
                
                <div class="form__input">
                    
                    <div class="form__item username">
                        
                        <input type="text" id="username__customer" name="username" class="form__control" autofocus="autofocus" required autocomplete="off" placeholder="Brugernavn" value="" />
                        
                    </div>
                    
                    <div class="form__item name">
                        
                        <input type="text" id="name__customer" name="name" class="form__control" required autocomplete="off" placeholder="Navn" value="" />
                        
                    </div>
                    
                    <div class="form__item email">
                        
                        <input type="email" id="email__customer" name="mail" class="form__control" required autocomplete="off" placeholder="Email" value="" />
                        
                    </div>
                    
                    <div class="form__item telephone">
                        
                        <input type="text" id="telephone__customer" name="type" class="form__control" required autocomplete="off" placeholder="Telefon nummer" value="" />
                        
                    </div>
                    
                    <div class="form__item type">
                        
                        <input type="text" id="type__customer" name="type" class="form__control" required autocomplete="off" placeholder="Elev, Lærer, SKP" />
                    </div>
                    
                </div>
                
                <!-- Modal cancel and create buttons -->
                
                <div class='modal__buttons'>

                    <a class='button square__button modal__button button__cancel button__red'>Cancel</a>
                    <button id='button__create__customer' class='button square__button modal__button button__green'>Create</button>

                </div>
                
            </form>

        </div>

    </div>

</div>