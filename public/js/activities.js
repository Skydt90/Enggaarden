$(function() {

    // bootstrap tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // on contribution create
    $('.activity-type-form').on('submit', function (e){
        e.preventDefault();
        const url = 'activity';
        const request = 'POST';
        const data = $(this).serialize();

        ajax_requests(url, request, data, true, function (result) {
            if (result.status === 200){
                $('.add-contribution').modal('hide');
                $(`<tr>
                    <td>${result.data.activity_type}</td>
                </tr>`).insertBefore('table > tbody > tr:first');
            }
        });
    });

    // trigger the modal based on member cridentials
    // $('.delete-button').on('click', function(e) {
    //     e.preventDefault();
    //     const id = $(this).data('id');
    //     const activity = $(this).data('activity');
    //     const modal = `<div id="delete-modal" class="modal fade">
    //                         <div class="modal-dialog">
    //                             <div class="modal-content">
    //                                 <div class="row">
    //                                     <div class="col md-12">
    //                                         <h3 class="text-center mt-3 mb-n1">Advarsel</h3>                      
    //                                     </div>
    //                                 </div>
    //                                 <div class="modal-body text-center">
    //                                     <p class="lead">Ønsker du virkelig at slette bidrag til ${activity} ?</p>
    //                                     <div class="row">
    //                                         <div class="col-md-12">
    //                                             <button type="button" class="btn btn-danger col-md-2 mr-2 mt-2" data-dismiss="modal">Nej</button>
    //                                             <button type="button" class="contribution-delete-button btn btn-success col-md-2 mt-2" onClick="deleteContribution(${id})" data-dismiss="modal">Ja</button>
    //                                         </div>
    //                                     </div>
    //                                 </div>
    //                             </div>
    //                         </div>
    //                     </div>`;
    //     $(modal).modal();
    // });
});

// function deleteContribution(id) {
//     const contributionID = id;
//     const url = '/contribution/' + contributionID;
//     const request = 'DELETE';
//     const row = $('a[data-id="'+ contributionID +'"]').parents('.table-row');

//     ajax_requests(url, request, contributionID, true, function(result) {
//         if(result.status === 200) {
//             row.fadeOut('slow', function() {
//                 $(this).remove();
//             });
//             console.log(result.status);
//         }
//     });
// }
$(function () {

    let events = [];

    $('.input').on('keyup', function(e) {
        if(e.keyCode === 9) { return; }
        
        const element = $(this);
        const id = $(this).attr('data-id');
        const url = '/activity/' + id;
        const data = $(this).val();
        
        events[element.attr('name')]; 
        
        clearTimeout(events[element.attr('name')]);

        events[element.attr('name')] = setTimeout(function() {
            ajax_requests(url, 'PUT', data, false, function(result) {
                console.log(result.status);
            });
        }, 1000);
    });

    $('.contribution-form').on('change', '.activity_type, .pay_date', function(e) {
        if(e.keyCode === 9) { return; }
        
        const id = $('.contribution-form').attr('data-id');
        const url = '/contribution/' + id;
        const data = $('.contribution-form').serialize();
       
        ajax_requests(url, 'PUT', data, false, function(result) {
            console.log(result.status);
        });
    });



});