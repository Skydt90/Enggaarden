if (typeof toastr !== 'undefined') {
	toastr.options = {
		closeButton: false,
		debug: false,
		newestOnTop: true,
		progressBar: true,
		positionClass: "toast-top-center",
		preventDuplicates: true,
		onclick: null,
		showDuration: 0,
		hideDuration: 0,
		timeOut: 5000,
		extendedTimeOut: 2000,
		showEasing: "swing",
		hideEasing: "linear",
		showMethod: "fadeIn",
		hideMethod: "fadeOut",
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
	};
}