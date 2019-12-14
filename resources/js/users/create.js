// register user
$('.register-form').on('submit', function(e) {
    e.preventDefault();
    const url = 'register';
    const request = 'POST';
    const data = $(this).serialize();

    ajax_requests(url, request, data, true, function(result) {
        if(result.status === 200) {
            $('.register-modal').modal('hide');
            $(`<tr>
                    <td> ${result.data.username} </td>
                    <td> ${result.data.user_type}</td>
                    <td></td>
                    <td></td>
                </tr>`).insertBefore('table > tbody > tr:first');
        }
    });
});