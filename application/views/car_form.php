
    <?php echo form_open('car/add_car'); ?>
        <div class="uk-child-width-1-2" uk-grid>
            <fieldset class="uk-fieldset">
                <legend class="uk-legend">Ogólne</legend>

                <div class="uk-margin">
                    <select class="uk-select">
                        <option>Brand</option>
                        <option>Option 02</option>
                    </select>
                </div>

                <div class="uk-margin">
                    <select class="uk-select">
                        <option>Model</option>
                        <option>Option 02</option>
                    </select>
                </div>

                <div class="uk-margin">
                    <input class="uk-input" type="number" placeholder="Cena">
                </div>
            </fieldset>
            <fieldset class="uk-fieldset">
                <legend class="uk-legend">Dzień</legend>

                <div class="uk-child-width-1-2 uk-margin-top" uk-grid>
                    <div>
                        <select class="uk-select">
                            <option>Od</option>
                            <option>Option 02</option>
                        </select>
                    </div>
  
                    <div>
                        <select class="uk-select">
                            <option>Od</option>
                            <option>Option 02</option>
                        </select>
                    </div>
                </div>

                <div class="uk-margin">
                    <input class="uk-input" type="text" placeholder="Input">
                </div>

                <div class="uk-text-center uk-margin-top">
                    <button class="uk-button uk-button-primary" type="submit">Dodaj</button>
                </div>
            </fieldset>
        </div>
        <div class="uk-text-center uk-margin-top">
            <button class="uk-button uk-button-primary" type="submit">Gotowe</button>
        </div>
    </form>