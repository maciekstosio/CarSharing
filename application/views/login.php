
    <?php echo form_open('user/auth', array("class" => "uk-position-center uk-overlay uk-overlay-default uk-text-center")); ?>
        <h2>Log In</h2>
        <div class="uk-margin">
            <div class="uk-inline">
                <a class="uk-form-icon" href="#" uk-icon="icon: mail"></a>
                <input class="uk-input uk-form-danger" name="email" type="text" placeholder="E-mail">
            </div>
        </div>
    
        <div class="uk-margin">
            <div class="uk-inline">
                <a class="uk-form-icon" href="#" uk-icon="icon: lock"></a>
                <input class="uk-input" type="password" name="password" placeholder="Password">
            </div>
        </div>

        <button class="uk-button uk-button-primary" type="submit">Log me in</button>
    </form>