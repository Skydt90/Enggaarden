$(function() {

    // register member
    $('.register-form').on('submit', function(e) {
        e.preventDefault();
        const url = this.id === 'register-company-modal' ? 'member-company' : 'member';
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

    // register member
    $('.btn-invite-form').on('click', function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        let form = $('#' + id);
        let url = "invite";
        
        const request = 'POST';
        const data = form.serialize();

        ajax_requests(url, request, data, true, function(result) {
            
            if(result.status === 200) {
                $('#div' + id).replaceWith('Inviteret allerede');
            }
        });
    });
});
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