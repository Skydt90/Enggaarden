$(function() {

    // bootstrap tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Focus the only input field on the show of add modal
    $('.add-activity-type').on('shown.bs.modal', function () {
        $(".activity_name").focus();
    });

    // on contribution create
    $('.activity-type-form').on('submit', function (e){
        e.preventDefault();
        const url = 'activity';
        const request = 'POST';
        const data = $(this).serialize();

        ajax_requests(url, request, data, true, function (result) {
            if (result.status === 200){
                $('.add-activity-type').modal('hide');
                $(`<tr class="table-row">
                <td><input type="text" class="form-control input" data-id="${result.data.id}" value="${result.data.activity_type}   GENINDLÆS FOR AT REDIGERE DETTE FELT"></td>
                </tr>`).insertBefore('table > tbody > tr:first');

                // $(`input[data-id="${result.data.id}"]`).load(`/activity input[data-id="${result.data.id}"]`, function () {
                //     alert($(this).val());
                // });


            }
        });
    });
});
