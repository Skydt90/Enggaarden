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