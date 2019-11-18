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