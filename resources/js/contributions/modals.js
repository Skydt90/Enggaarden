$(function() {

    // bootstrap tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // on contribution create
    $('.contribution-form').on('submit', function (e){
        e.preventDefault();
        const url = 'contribution';
        const request = 'POST';
        const data = $(this).serialize();

        ajax_requests(url, request, data, true, function (result) {
            if (result.status === 200){
                const options = {  day: 'numeric', month: 'short', year: 'numeric'};
                const date = new Date(result.data.pay_date);
                $('.add-contribution').modal('hide');
                $(`<tr>
                    <td>${result.data.activity_type.activity_type}</td>
                    <td>${result.data.amount} kr</td>
                    <td>${date.toLocaleDateString('da-DA', options)}</td>
                    <td>
                    <a data-toggle="tooltip" data-placement="top" title="Rediger" href="/contribution/${result.data.id}"><i class="fas fa-edit"></i></a>
                    <a class="ml-2 delete-button" data-id="${result.data.id}" data-activity="${result.data.activity_type.activity_type }" href=""><i data-toggle="tooltip" data-placement="top" title="Slet" style="color: red" class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>`).insertBefore('table > tbody > tr:first');
            }
        });
    });

    // trigger the modal based on member cridentials
    $('.delete-button').on('click', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        const activity = $(this).data('activity');
        const modal = `<div id="delete-modal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="row">
                                        <div class="col md-12">
                                            <h3 class="text-center mt-3 mb-n1">Advarsel</h3>                      
                                        </div>
                                    </div>
                                    <div class="modal-body text-center">
                                        <p class="lead">Ønsker du virkelig at slette bidrag til ${activity} ?</p>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-danger col-md-2 mr-2 mt-2" data-dismiss="modal">Nej</button>
                                                <button type="button" class="contribution-delete-button btn btn-success col-md-2 mt-2" onClick="deleteContribution(${id})" data-dismiss="modal">Ja</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
        $(modal).modal();
    });
});

function deleteContribution(id) {
    const contributionID = id;
    const url = '/contribution/' + contributionID;
    const request = 'DELETE';
    const row = $('a[data-id="'+ contributionID +'"]').parents('.table-row');

    ajax_requests(url, request, contributionID, true, function(result) {
        if(result.status === 200) {
            row.fadeOut('slow', function() {
                $(this).remove();
            });
            console.log(result.status);
        }
    });
}