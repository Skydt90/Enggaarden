document.addEventListener("DOMContentLoaded", function() {

    if($('.errors').length > 0) {
        const errors = $('.errors').children('span');
        let message = '';

        $.each(errors, function(i) {
            message += $(errors[i]).text().trim() + '<br>';
        });
        $.toastr.error.show(message);
    }

    if($('.success').length > 0) {
        const messages = $('.success').children('span');
        let message = '';

        $.each(messages, function(i) {
            message += $(messages[i]).text().trim() + '<br>';
        });
        $.toastr.success.show(message);
    }

});