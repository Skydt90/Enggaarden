$(function() {

    // Focus the only input field on the show of add modal
    $('.add-activity-type').on('shown.bs.modal', function () {
        $(".activity_name").focus();
    });

    // on contribution create
    $('.activity-type-form').on('submit', function(e) {
        e.preventDefault();
        const url = 'activity';
        const request = 'POST';
        const data = $(this).serialize();

        ajax_requests(url, request, data, true, function (result) {
            if (result.status === 200) {
                $('.add-activity-type').modal('hide');
                $(`<input type="text" class="form-control input col-md-3" data-id="${result.data.id}" value="${result.data.activity_type} (Reload for at redigere)">`).appendTo('table > tbody > tr > td');
            }
        });
    });
});
