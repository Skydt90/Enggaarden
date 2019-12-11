let events = [];

$('.contribution-form').on('keyup', '.input', function(e) {
    if(e.keyCode === 9) { return; }
    
    const element = $(this);
    const id = $('.contribution-form').attr('data-id');
    const url = '/contribution/' + id;
    const data = $('.contribution-form').serialize();
    
    events[element.attr('name')]; 
    
    clearTimeout(events[element.attr('name')]);

    events[element.attr('name')] = setTimeout(function() {
        ajax_requests(url, 'PUT', data, false, function(result) {
            console.log(result.status);
        });
    }, 1000);
});

$('.contribution-form').on('change', '.activity_type, .pay_date', function(e) {
    if(e.keyCode === 9) { return; }
    
    const id = $('.contribution-form').attr('data-id');
    const url = '/contribution/' + id;
    const data = $('.contribution-form').serialize();
    
    ajax_requests(url, 'PUT', data, false, function(result) {
        console.log(result.status);
    });
});



