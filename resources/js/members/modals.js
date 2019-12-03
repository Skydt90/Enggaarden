$(function() {
    
    // bootstrap tooltips
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

    // trigger the modal based on member cridentials
    $('.delete-button').on('click', function() {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const modal = `<div id="delete-modal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="row">
                                        <div class="col md-12">
                                            <h3 class="text-center mt-3 mb-n1">Advarsel</h3>                      
                                        </div>
                                    </div>
                                    <div class="modal-body text-center">
                                        <p class="lead">Ønsker du virkelig at slette "${name}" ?</p>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-danger col-md-2 mr-2 mt-2" data-dismiss="modal">Nej</button>
                                                <button type="button" class="member-delete-button btn btn-success col-md-2 mt-2" onClick="deleteMember(${id})" data-dismiss="modal">Ja</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
        $(modal).modal();
    });

});

// delete member targeted by id
function deleteMember(id) {
    const memberID = id;
    const url = '/member/' + memberID;
    const request = 'DELETE';
    const row = $('a[data-id="'+ memberID +'"]').parents('.table-row');
    
    ajax_requests(url, request, memberID, true, function(result) {
        if(result.status === 200) {
            row.fadeOut('fast', function() {
                $(this).remove();
            });
            console.log(result.status);
        }
    });
}