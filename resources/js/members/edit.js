$(function() {

    let events = [];
    
    // this is for updating members
    $('.member-form').on('keyup', '.input', function(e) {
        if(e.keyCode === 9) { return; }
        
        const element = $(this);
        const id = $('.member-form').attr('data-id');
        const url = '/member/' + id;
        const data = $('.member-form').serialize();
        
        events[element.attr('name')]; 
        
        clearTimeout(events[element.attr('name')]);

        events[element.attr('name')] = setTimeout(function() {
            ajax_requests(url, 'PUT', data, false, function(result) {
                console.log(result.status);
            });
        }, 1000);
    });

    $('.member-form').on('change', '.is-board, .member-type', function(e) {
        if(e.keyCode === 9) { return; }
        
        const id = $('.member-form').attr('data-id');
        const url = '/member/' + id;
        const data = $('.member-form').serialize();
       
        ajax_requests(url, 'PUT', data, false, function(result) {
            console.log(result.status);
        });
    });

    $('.address-form').on('keyup', '.input', function(e) {
        if(e.keyCode === 9 || typeof e.keyCode === 'undefined') { return; }
        
        const element = $(this);
        const id = $('.address-form').attr('data-id');
        const url = '/member/' + id;
        const data = $('.address-form').serialize();
        
        events[element.attr('name')];
        
        clearTimeout(events[element.attr('name')]);
        
        events[element.attr('name')] = setTimeout(function() {
            ajax_requests(url, 'PUT', data, false, function(result) {
                console.log(result.status);
            });
        }, 1000);
    });

    $('.subscription-form').on('change', '.pay-date', function(e) {
        if(e.keyCode === 9) { return; }
        
        const id = $('.subscription-form').attr('data-id');
        const url = '/member/' + id;
        const data = $('.subscription-form').serialize();
        
        ajax_requests(url, 'PUT', data, false, function(result) {
            console.log(result.status);
        });
    });

    $('.subscription-form').on('keyup', '.input', function(e) {
        if(e.keyCode === 9 || typeof e.keyCode === 'undefined') { return; }
        
        const element = $(this);
        const id = $('.subscription-form').attr('data-id');
        const url = '/member/' + id;
        const data = $('.subscription-form').serialize();
        
        events[element.attr('name')];
        
        clearTimeout(events[element.attr('name')]);
        
        events[element.attr('name')] = setTimeout(function() {
            ajax_requests(url, 'PUT', data, false, function(result) {
                console.log(result.status);
            });
        }, 1000);
    });

});