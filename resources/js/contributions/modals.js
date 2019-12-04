$(function() {

    // on contribution create
    $('.contribution-form').on('submit', function (e){
        e.preventDefault();
        const url = 'contribution';
        const request = 'POST';
        const data = $(this).serialize();

        ajax_requests(url, request, data, true, function (result) {
            if (result.status === 200){
                $('.add-contribution').modal('hide');
            }
        });
    });








});