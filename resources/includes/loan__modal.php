<!-- Loan modal for creating new loans -->

<div class="modal modal__effect__1" id="loan__modal">

    <div class="modal__content">

        <div class="modal__title">Udlån vare</div>
        
        <!-- Loan form container -->

        <div class="modal__text">
            
            <form id="edit__entry" class="simple__form" action="./" method="post" accept-charset="UTF-8" novalidate="novalidate" autocomplete="off">
                
                <div class="form__input">
                    
                    <div class="form__item username">
                        
                        <input type="text" id="username__loan" name="username" class="form__control" autofocus="autofocus" required autocomplete="off" placeholder="Brugernavn" value="" />
                        
                    </div>
                    
                    <div class="form__item item__number">
                        
                        <input type="text" id="item__loan" name="item__number" class="form__control" required autocomplete="off" placeholder="Varenummer" value="" />
                        
                    </div>
                    
                    <div class="form__item loan__date">
                        
                        <input type="text" id="date__loan" name="loan__date" class="form__control" required autocomplete="off" placeholder="Udløbsdato" value="" />
                        
                    </div>
                    
                    <div class="form__item quantity">
                        
                        <input type="number" id="quantity__loan" name="quantity" class="form__control" required autocomplete="off" placeholder="Antal" min='1' value="1" />
                        
                    </div>
                    
                    <div class='form__item permanent'>
                        
                        <input type="checkbox" id="bool__loan" name="bool__loan" />
                        <label for="bool__loan"></label>
                        <span class="bool__label">Permanent</span>
                        
                    </div>
                    
                </div>
                
                 <div class='modal__buttons'>

                    <a class='button square__button modal__button button__cancel button__red'>Cancel</a>
                    <button id='button__loan' class='button square__button modal__button button__green'>Udlån</button>

                </div>
                
            </form>

        </div>

    </div>

</div>

<!-- Modal overlay for closing when clicking outside the pop up -->

<div class="modal__overlay"></div>