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
        }, 700);
    });
});