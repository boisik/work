<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<div class="row">
    <div class="col-md-3 col-md-offset-3  col-lg-3 col-lg-offset-3 col-sm-12 col-xs-12 center-block">
        <fieldset>
            <legend>Редактировать Пользователя</legend>

            <form method="POST" id="UserEdit" data-action="UserEdit/">
                <label for="add_name"> Ваше имя</label><br/>
                <input  type="text" id="add_name" name="add_name" value="<?php printf($data->getName());  ?>"/><br/>
                <label for="add_pass"> Пароль</label><br/>
                <input disabled type="text" id="add_pass" name="add_pass" value=""/><br/><br/>

                <input type="checkbox" name="changePass" id="changePass"  />  <label for="add_pass">Изменить Пароль</label><br/>
                <br/>
                <input type="hidden" name="operation" value="UserEdit"/>
                <input type="submit"/>
            </form>

        </fieldset>
    </div>
    <div class="col-md-3 col-md-offset-3  col-lg-3 col-lg-offset-3 col-sm-12 col-xs-12 center-block">
        <div id="errors" class="errors">
        </div>

    </div>
    <script>
        $(document).ready(function() {
            $('#changePass').change(function() {
                if ($('#add_pass').attr('disabled')) $('#add_pass').removeAttr('disabled');
                else $('#add_pass').attr('disabled', 'disabled');
            });
        });
    </script>


