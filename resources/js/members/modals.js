$(document).ready(function(){

    $('.register-form').on('submit', function(e) {
        e.preventDefault();
        
        ajax_calls('member', 'POST', $(this).serialize(), true, function(result) {
            
            if(result.status === 200) {
                $('#register-modal').modal('hide');
                $(`<tr>
                        <td> ${result.data.first_name} ${result.data.last_name} </td>
                        <td> ${result.data.member_type}</td>
                        <td> dummy data </td>
                        <td></td>
                    </tr>`).insertBefore('table > tbody > tr:first');
            }
        });
    });
});