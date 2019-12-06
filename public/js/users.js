$(function () {

    // bootstrap tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // trigger the modal based on member cridentials
    $('.delete-button').on('click', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        const username = $(this).data('username');
        const modal = `<div id="delete-modal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="row">
                                        <div class="col md-12">
                                            <h3 class="text-center mt-3 mb-n1">Advarsel</h3>                      
                                        </div>
                                    </div>
                                    <div class="modal-body text-center">
                                        <p class="lead">Ønsker du virkelig at slette brugeren ${username} ?</p>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-danger col-md-2 mr-2 mt-2" data-dismiss="modal">Nej</button>
                                                <button type="button" class="user-delete-button btn btn-success col-md-2 mt-2" onClick="deleteUser(${id})" data-dismiss="modal">Ja</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
        $(modal).modal();
    });

});

function deleteUser(id) {
    const userID = id;
    const url = '/user/' + userID;
    const request = 'DELETE';
    const row = $('a[data-id="' + userID + '"').parents('.table-row');

    ajax_requests(url, request, userID, true, function(result) {
        if(result.status === 200) {
            row.fadeOut('slow', function() {
                $(this).remove();
            });
            console.log(result.status);
        }
    });
}