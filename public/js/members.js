$(function() {
    $('[data-toggle="tooltip"]').tooltip();
    // register member
    $('.register-form').on('submit', function(e) {
        e.preventDefault();
        const url = 'member';
        const request = 'POST';
        const data = $(this).serialize();

        ajax_requests(url, request, data, true, function(result) {
            
            if(result.status === 200) {
                $('.register-modal').modal('hide');
                $(`<tr>
                        <td> ${result.data.first_name} ${result.data.last_name || ''} </td>
                        <td> ${result.data.member_type}</td>
                        <td> dummy data </td>
                        <td></td>
                    </tr>`).insertBefore('table > tbody > tr:first');
            }
        });
    });
});
$(document).ready(function(){

    $('.btn-invite-form').on('click', function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        let form = $('#' + id);
        let url = "invite";
        
        const request = 'POST';
        const data = form.serialize();

        ajax_requests(url, request, data, true, function(result) {
            
            if(result.status === 200) {
                $('#div' + id).replaceWith('<i class="fas fa-hourglass-half"></i> Afventer</td>');
            }
        });
    });
});
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

    $('.subscription-form').on('change', '.input', function(e) {
        if(e.keyCode === 9) { return; }
        
        const id = $('.subscription-form').attr('data-id');
        const url = '/member/' + id;
        const data = $('.subscription-form').serialize();
        
        ajax_requests(url, 'PUT', data, false, function(result) {
            console.log(result.status);
        });
    });

});