function ajax_calls(url, request, data, showSuccess, callback) {
    $.ajax({
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: request,
        data: data,
        success: function(result) {
            var message = '';
            
            if(result.code === 400) {
                for(var key in result.errors) {
                    message += result.errors[key] + "<br>";
                }

                $.toastr.error.show(message);

                // only stops here if force callback is not equal to true.
                if(callback !== undefined) {
                    return callback(result);
                }
                return;
            }
            if(showSuccess === true) {
                $.toastr.success.show(result.message);
            }
            if(callback !== undefined) {
                return callback(result);
            }
        },
        error: function(error) {
            //hideLoader();
            if(error.status === 422) {
                var returnData = JSON.parse(error.responseText);
                returnData.status = error.status;

                handleBadRequestMessage(error.responseJSON);
            }
            if(error.status === 400) { // bad request
                var returnData = JSON.parse(error.responseText);
                returnData.status = error.status;
                
                handleBadRequestMessage(returnData);
            }
            if(error.status === 404) { // page not found (wrong link provided)
                $.toastr.warning.show('The link provided for the ajax call is not correct, please check it, and make correction to it.');
            }
            if(error.status === 500) {
                /* $.post('/error/log/create', {
                    _token:_token,
                    error: error.responseText,
                    function: 'ajax request',
                }, function(result) {
                    console.log(result);
                }); */
                $.toastr.error.show('Noget gik galt under håndteringen af din forespørgsel. En log er blevet oprettet hvor vi kan se hvad der gik galt. Vi undskylder ulejligheden.');
            }
            if(callback !== undefined) {
                callback(returnData);
            }
        }
    });
}

function handleBadRequestMessage(returnData)
{
    var message = '';
    //hideLoader();
    
    if(typeof returnData.error_title !== 'undefined') {
        message += returnData.error_title + '<br><br>';
    }

    if(typeof returnData.errors !== 'undefined') {
        for(var key in returnData.errors) {
            if(returnData.errors[key][0].length > 1) { // for laravel validation messages()
                message += returnData.errors[key][0] + "<br>";
            } else {
                message += returnData.errors[key] + "<br>";
            }
        }
    } else {
        message = returnData.error;
    }

    $.toastr.error.show(message);
}