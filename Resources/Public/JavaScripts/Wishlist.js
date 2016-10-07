/**
 * Created by michel on 20/05/15.
 */
(function(scope, $) {
    $(function() {
        $('.wish-registration-showbutton').on('click', function (e) {
            e.preventDefault();
            $(this).fadeOut("slow", function(){
                $(this).parent().children('.wish-registration-form-extended').fadeIn();
            });
        });

        $('.wish-registration-form').on('submit', function (e) {
            var formObj = $(this);
            var valid = true;
            var emailError = false;
            var numberError = false;

            // check required fields
            $.each($(formObj).find('.required'), function(key, field){
                if(!$(field).val()){
                    valid = false;
                    console && console.log('field required');
                }
            });

            // check mail
            $.each($(formObj).find('.email'), function(key, field){
                if($(field).val()){
                    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
                    if(!re.test($(field).val())){
                        valid = false;
                        emailError = true;
                        console && console.log('invalid email');
                    }
                }
            });

            // check number
            $.each($(formObj).find('.number'), function(key, field){
                if($(field).val()){
                    var re = /^[0-9]*$/i;
                    if(!re.test($(field).val())){
                        valid = false;
                        numberError = true;
                        console && console.log('invalid number');
                    }
                }
            });

            if(valid){
                // disable button
                $(formObj).find('.button').prop('disabled', true);

                var formURL = formObj.attr("action");
                var formData = formObj.serialize();

                $.ajax({
                    url: formURL,
                    type: 'POST',
                    data: formData,
                    mimeType: "multipart/form-data",
                    //contentType: false,
                    cache: false,
                    //processData:false,
                    success: function (data) {
                        // Replace the form with the replied content
                        $(formObj).parents('.registration').replaceWith(data);
                    }
                });
            } else {
                var error = 'Bitte alle Felder korrekt ausfüllen!';
                if(emailError){
                    error += "\nE-Mail ungültig!"
                }
                if(numberError){
                    error += "\nBetrag ungültig, bitte nur Zahlen verwenden. Keine Trennzeichen etc."
                }
                alert(error);
            }
            //Prevent the browser from submitting the form and cause page reload
            e.preventDefault();
        });
    });
})(window, jQuery);