<!-- Create user modal to create new customers -->

<div class="modal modal__effect__1" id="item__modal">
    
    <!-- Pop up box content -->

    <div class="modal__content">

        <div class="modal__title">Opret Vare</div>
        
        <!-- Container with registration form -->

        <div class="modal__text">
            
            <form id="create__entry" class="simple__form" action="./" method="post" accept-charset="UTF-8" novalidate="novalidate" autocomplete="off">
                
                <div class="form__input">
                    
                    <div class="form__item item__number">
                        
                        <input type="text" id="itemnumber__create" name="username" class="form__control" autofocus="autofocus" required autocomplete="off" placeholder="Varenummer" value="" />
                        
                    </div>
                    
                    <div class="form__item item__name">
                        
                        <input type="text" id="itemname__create" name="name" class="form__control" required autocomplete="off" placeholder="Varenavn" value="" />
                        
                    </div>
                    
                    <div class="form__item category">
                        
                        <input type="text" id="category__create" name="mail" class="form__control" required autocomplete="off" placeholder="Kategori" value="" />
                        
                    </div>
                    
                    <div class="form__item sub__category">
                        
                        <input type="text" id="subcategory__create" name="type" class="form__control" required autocomplete="off" placeholder="Subkategori" value="" />
                        
                    </div>
                    
                    <div class="form__item item__description">
                        
                        <input type="text" id="description__create" name="type" class="form__control" required autocomplete="off" placeholder="Beskrivelse" />
                        
                    </div>
                    
                    <div class="form__item item__place">
                        
                        <input type="text" id="place__create" name="type" class="form__control" required autocomplete="off" placeholder="Placering: Munkebjergvej eller Petersmindevej" />
                        
                    </div>
                    
                    <div class="form__item item__quantity">
                        
                        <input type="number" min="1" id="quantity__create" name="type" class="form__control" required autocomplete="off" value="1" placeholder="Antal" />
                        
                    </div>
                    
                </div>
                
                <!-- Modal cancel and create buttons -->
                
                <div class='modal__buttons'>

                    <a class='button square__button modal__button button__cancel button__red'>Cancel</a>
                    <button id='button__create__item' class='button square__button modal__button button__green'>Create</button>

                </div>
                
            </form>

        </div>

    </div>

</div>