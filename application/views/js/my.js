/**
 * Created by Керчь on 18.06.2020.
 */

    $(document).ready(function () {
        $('form').submit(function () {
            var actionurl = $(this).data("action");
            var formID = $(this).attr('id'); // Получение ID формы
            var formNm = $('#' + formID);

            $.ajax({
                type: 'POST',
                url: actionurl, // Обработчик формы отправки
                data: formNm.serialize(),
                success: function (data) {


                    $('.errors').html(data);
                }
            });
            return false;
        });
    });
