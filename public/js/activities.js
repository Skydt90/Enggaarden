$(function() {

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

$(function () {

    let events = [];

    $('.input').on('keyup', function(e) {
        if(e.keyCode === 9) { return; }
        
        const element = $(this);
        const id = $(this).attr('data-id');
        const url = '/activity/' + id;
        let data = {
            'activity_type' : $(this).val()
        };
        
        events[element.attr('name')]; 
        
        clearTimeout(events[element.attr('name')]);

        events[element.attr('name')] = setTimeout(function() {
            ajax_requests(url, 'PUT', data, false, function(result) {
                console.log(result.status);
            });
        }, 1000);
    });



});