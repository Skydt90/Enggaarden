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
                        <td><i data-toggle="tooltip" data-placement="right" title="Ikke Betalt" class="fas fa-times" style="color: red"></i></td>
                        <td> 0 kr. </td>
                        <td><i class="fas fa-hourglass-half"></i> Afventer</td>
                        <td>
                            <a data-toggle="tooltip" data-placement="top" title="Rediger" href="http://enggaarden.local/member/${result.data.id}"><i class="fas fa-edit"></i></a>
                            <a data-toggle="tooltip" data-placement="top" title="Send Mail" class="ml-2" href="http://enggaarden.local/email/${result.data.id}" style="color:orange"><i class="fas fa-envelope"></i></a>
                            <a class="ml-2 delete-button" data-id="${result.data.id}" data-name="${result.data.first_name}"><i data-toggle="tooltip" data-placement="top" title="Slet" style="color: red" class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>`).insertBefore('table > tbody > tr:first');
            }
        });
    });

    // trigger the modal based on member cridentials
    $('.delete-button').on('click', function(e) {
        e.preventDefault();
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
            row.fadeOut('slow', function() {
                $(this).remove();
            });
            console.log(result.status);
        }
    });
}