// trigger the modal based on email cridentials
$('.delete-button').on('click', function(e) {
    e.preventDefault();
    const id = $(this).data('id');
    const modal = `<div id="delete-modal" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="row">
                                    <div class="col md-12">
                                        <h3 class="text-center mt-3 mb-n1">Advarsel</h3>                      
                                    </div>
                                </div>
                                <div class="modal-body text-center">
                                    <p class="lead">Ønsker du virkelig at slette denne email?</p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-danger col-md-2 mr-2 mt-2" data-dismiss="modal">Nej</button>
                                            <button type="button" class="member-delete-button btn btn-success col-md-2 mt-2" onClick="deleteEmail(${id})" data-dismiss="modal">Ja</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
    $(modal).modal();
});

// delete email targeted by id
function deleteEmail(id) {
    const emailID = id;
    const url = '/email/' + emailID;
    const request = 'DELETE';
    const row = $('a[data-id="'+ emailID +'"]').parents('.table-row');

    ajax_requests(url, request, emailID, true, function(result) {
        if(result.status === 200) {
            row.fadeOut('slow', function() {
                $(this).remove();
            });
            console.log(result.status);
        }
    });
}