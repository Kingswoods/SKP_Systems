<!-- Return modal for returning loans-->

<div class="modal modal__effect__1" id="return__modal">

    <div class="modal__content">

        <div class="modal__title">Returner vare</div>
        
        <!-- Return form container -->

        <div class="modal__text">
            
            <form id="edit__entry" class="simple__form" action="./" method="post" accept-charset="UTF-8" novalidate="novalidate" autocomplete="off">
                
                <div class="form__input">
                    
                    <div class="form__item username">
                        
                        <input type="text" id="username__return" name="username" class="form__control" autofocus="autofocus" required autocomplete="off" placeholder="Brugernavn" value="" />
                        
                    </div>
                    
                    <div class="form__item item__number">
                        
                        <input type="text" id="item__return" name="item__number" class="form__control" required autocomplete="off" placeholder="Varenummer" value="" />
                        
                    </div>
                    
                    <div class="form__item quantity">
                        
                        <input type="number" id="quantity__return" name="quantity" class="form__control" required autocomplete="off" placeholder="Antal" min='1' value="1" />
                        
                    </div>
                    
                </div>
                
                 <div class='modal__buttons'>

                    <a class='button square__button modal__button button__cancel button__red'>Cancel</a>
                    <button id='button__return' class='button square__button modal__button button__green'>Returner</button>

                </div>
                
            </form>

        </div>

    </div>

</div>