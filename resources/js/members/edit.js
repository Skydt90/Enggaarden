$(function() {

    let events = [];

    $('.member-form').on('keyup change', '.form-control', function(e) {

        if(e.keyCode === 9) { return; }
        
        const element = $(this);
        const id = $('.member-form').attr('data-id');
        const url = '/member/' + id;
        const data = $('.member-form').serialize();
        const choice = element.is('select') || element.is(':checkbox') || element.is(':radio');
        
        events[element.attr('name')];
        
        clearTimeout(events[element.attr('name')]);
        
        if(choice) {
            ajax_requests(url, 'PUT', data, true, function(result) {
                console.log(result.status);
            });
            return;
        }
        events[element.attr('name')] = setTimeout(function() {
            ajax_requests(url, 'PUT', data, true, function(result) {
                console.log(result.status);
            });
        }, 2000);
    });

});