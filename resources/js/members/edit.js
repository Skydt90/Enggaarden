$(function() {

    let events = [];

    // this is for updating members
    $('.member-form').on('keyup', '.form-control', function(e) {
        if(e.keyCode === 9) { return; } // tab key
        
        const element = $(this);
        const id = $('.member-form').attr('data-id');
        const url = '/member/' + id;
        const data = $('.member-form').serialize();
        const choice = element.is('select') || element.is(':checkbox') || element.is(':radio');
        
        events[element.attr('name')]; // add event to global var
        
        clearTimeout(events[element.attr('name')]); // clear pre-existing vars with same name
        
        // for choice we dont need a timer
        if(choice) {
            ajax_requests(url, 'PUT', data, true, function(result) {
                console.log(result.status);
            });
            return;
        }
        // timer for saving input fields
        events[element.attr('name')] = setTimeout(function() {
            ajax_requests(url, 'PUT', data, true, function(result) {
                console.log(result.status);
            });
        }, 2000);
    });

});