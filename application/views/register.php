    <?php echo form_open('user/register', array("class" => "uk-position-center uk-overlay uk-overlay-default uk-text-center")); ?>
        <h2>Sign Up</h2>

        <div class="uk-margin">
            <div class="uk-inline">
                <a class="uk-form-icon " href="#" uk-icon="icon: mail"></a>
                <input class="uk-input uk-form-danger" type="text" name="email" placeholder="E-mail">
            </div>
        </div>

        <div class="uk-margin">
            <div class="uk-inline">
                <a class="uk-form-icon" href="#" uk-icon="icon: user"></a>
                <input class="uk-input" type="text" name="name" placeholder="Name">
            </div>
        </div>

        <div class="uk-margin">
            <div class="uk-inline">
                <a class="uk-form-icon" href="#" uk-icon="icon: user"></a>
                <input class="uk-input" type="text" name="surname" placeholder="Surname">
            </div>
        </div>

        <div class="uk-margin">
            <div class="uk-inline">
                <a class="uk-form-icon" href="#" uk-icon="icon: lock"></a>
                <input class="uk-input" type="password" name="password" placeholder="Password">
            </div>
        </div>
    
        <div class="uk-margin">
            <div class="uk-inline">
                <a class="uk-form-icon" href="#" uk-icon="icon: lock"></a>
                <input class="uk-input" type="password" name="repassword" placeholder="Re-enter password">
            </div>
        </div>

        <button class="uk-button uk-button-primary" type="submit">Sign me up</button>
    </form>