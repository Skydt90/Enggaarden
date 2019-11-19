$(document).ready(function(){

    // register member
    $('.register-form').on('submit', function(e) {
        e.preventDefault();
        const url = 'member';
        const request = 'POST';
        const data = $(this).serialize();

        ajax_requests(url, request, data, true, function(result) {
            
            if(result.status === 200) {
                $('#register-modal').modal('hide');
                $(`<tr>
                        <td> ${result.data.first_name} ${result.data.last_name} </td>
                        <td> ${result.data.member_type}</td>
                        <td> dummy data </td>
                        <td></td>
                    </tr>`).insertBefore('table > tbody > tr:first');
            }
        });
    });
});

function ajax_requests(url, request, data, showSuccess, callback) {
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
if (typeof toastr !== 'undefined') {
	toastr.options = {
		closeButton: true,
		debug: false,
		newestOnTop: true,
		progressBar: true,
		positionClass: "toast-top-center",
		preventDuplicates: true,
		onclick: null,
		showDuration: 300,
		hideDuration: 1000,
		timeOut: 8000,
		extendedTimeOut: 3000,
		showEasing: "swing",
		hideEasing: "linear",
		showMethod: "fadeIn",
		hideMethod: "fadeOut",
		// Used if toastr message needs to stay open
		// timeOut: 0,
		// extendedTimeOut: 0,
	};

	$.toastr = {
		warning: {
			show: function(text) {
				toastr.warning(text, '');
			}
		},
		error: {
			show: function(text) {
				toastr.error(text, '');
			}
		},
		success: {
			show: function(text) {
				toastr.success(text, '');
			}
		},
		info: {
			show: function(text) {
				toastr.info(text, '');
			}
		},
		action: {
			show: function(text, header, btntxt) {
				var first = typeof btntxt != 'undefined' ? btntxt[0] : "Ja";
				var second = typeof btntxt != 'undefined' ? btntxt[1] : "Nej";
				
				toastr.info(text + '<br><br><div class="action-toastr-buttons">'
				+'<button type="button" id="confirmationRevertYes" class="btn btn-success" onclick="toastr_action_yes_handler();">' + first + '</button>'
				+'<button type="button" id="confirmationRevertNo" class="btn btn-danger" onclick="toastr_action_no_handler();">' + second + '</button>'
				+'</div>'
				, ((typeof header != 'undefined') ? header : ''), {
					closeButton: false,
					allowHtml: true,
					timeOut: 240000,
					progressBar: false, // true,
					extendedTimeOut: 8000,
					tapToDismiss: false,
				    onclick: false,
				    closeOnHover: false,
					onShown: function (toast) {
						$("#confirmationRevertYes").click(function() {
							console.log('clicked yes');
						});

						$("#confirmationRevertNo").click(function() {
							$('#toast-container').fadeOut(400, function() {
								$(this).remove();
								toastr.clear();
							});
						});
					}
				});
			}
		},
		singleAction: {	//currently only used when switching away from "company" while warning signs are active
			show: function(text) {
				toastr.info(text + '<div class="action-toastr-buttons2">'
				+'<button type="button" class="button-green" id="confirmationRevertYes" onclick="toastr_action_yes_handler();">Ok, will review</button>'
				+'<button type="button" class="button-red" id="confirmationRevertNo" onClick="toastr_action_no_handler();">Review Later</div>', '',
				{
					//iconClass: 'toast-info2',
					closeButton: false,
					allowHtml: true,
					timeOut: 240000,
					progressBar: false,
					extendedTimeOut: 8000,
					tapToDismiss: false,
				    onclick: false,
				    closeOnHover: false,
					onShown: function () {
						$("#confirmationRevertYes").click(function() {
							console.log('clicked yes');
							$('#toast-container').fadeOut(400, function() {
								$(this).remove();
								toastr.clear();
							});
						});
					}
				});
			}
		}
	};
}

var action_yes_variable = '';
var action_no_variable = '';

function toastr_action_yes_handler() {
	var action_handler = new Function (action_yes_variable);
	return action_handler();
}
function toastr_action_no_handler() {
	var action_handler = new Function (action_no_variable);
	return action_handler();
}