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