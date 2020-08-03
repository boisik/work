<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <div class="row">
            <div class="col-md-3 col-md-offset-3  col-lg-3 col-lg-offset-3 col-sm-12 col-xs-12 center-block">
                <fieldset>
                    <legend>Авторизация</legend>

                    <form method="POST" id="auth" data-action="/auth/auth">
                        <label for="add_name">Введите Ваш Логин</label><br/>
                        <input type="text" id="add_name" name="add_login" value=""/>

                        <label for="add_email">Введите Пароль</label><br/>
                         <input type="text" id="add_pass" name="add_pass" value=""/>
                        <p class="p_note"></p>
                        <input type="hidden" name="operation" value="auth"/>
                        <input type="submit"/>
                    </form>

                </fieldset>
            </div>
            <div class="col-md-3 col-md-offset-3  col-lg-3 col-lg-offset-3 col-sm-12 col-xs-12 center-block">
                <div id="errors" class="errors">
            </div>

        </div>


