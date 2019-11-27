$(document).ready(function(){

    // register member
    $('.register-form').on('submit', function(e) {
        e.preventDefault();
        let url = 'member';
        if(this.id=='register-company-modal')
        {
            url = 'member-company';
        }
        const request = 'POST';
        const data = $(this).serialize();

        ajax_requests(url, request, data, true, function(result) {
            
            if(result.status === 200) {
                $('.register-modal').modal('hide');
                if(result.data.last_name!=null)
                {
                    $(`<tr>
                            <td> ${result.data.first_name} ${result.data.last_name} </td>
                            <td> ${result.data.member_type}</td>
                            <td> dummy data </td>
                            <td></td>
                        </tr>`).insertBefore('table > tbody > tr:first');
                } else{
                    $(`<tr>
                            <td> ${result.data.first_name} </td>
                            <td> ${result.data.member_type}</td>
                            <td> dummy data </td>
                            <td></td>
                        </tr>`).insertBefore('table > tbody > tr:first');
                }
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