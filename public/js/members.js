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
                            <a data-toggle="tooltip" data-placement="top" title="Rediger" href="/member/${result.data.id}"><i class="fas fa-edit"></i></a>
                            <a data-toggle="tooltip" data-placement="top" title="Send Mail" class="ml-2" href="/email/${result.data.id}" style="color:orange"><i class="fas fa-envelope"></i></a>
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
$(document).ready(function(){

    $('.btn-invite-form').on('click', function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        let form = $('#' + id);
        let url = "invite";
        
        const request = 'POST';
        const data = form.serialize();

        ajax_requests(url, request, data, true, function(result) {
            
            if(result.status === 200) {
                $('#div' + id).replaceWith('<i class="fas fa-hourglass-half"></i> Afventer</td>');
            }
        });
    });
});
$(function() {

    let events = [];
    
    // this is for updating members
    $('.member-form').on('keyup', '.input', function(e) {
        if(e.keyCode === 9) { return; }
        
        const element = $(this);
        const id = $('.member-form').attr('data-id');
        const url = '/member/' + id;
        const data = $('.member-form').serialize();
        
        events[element.attr('name')]; 
        
        clearTimeout(events[element.attr('name')]);

        events[element.attr('name')] = setTimeout(function() {
            ajax_requests(url, 'PUT', data, false, function(result) {
                console.log(result.status);
            });
        }, 1000);
    });

    $('.member-form').on('change', '.is-board, .member-type', function(e) {
        if(e.keyCode === 9) { return; }
        
        const id = $('.member-form').attr('data-id');
        const url = '/member/' + id;
        const data = $('.member-form').serialize();
       
        ajax_requests(url, 'PUT', data, false, function(result) {
            console.log(result.status);
        });
    });

    $('.address-form').on('keyup', '.input', function(e) {
        if(e.keyCode === 9 || typeof e.keyCode === 'undefined') { return; }
        
        const element = $(this);
        const id = $('.address-form').attr('data-id');
        const url = '/member/' + id;
        const data = $('.address-form').serialize();
        
        events[element.attr('name')];
        
        clearTimeout(events[element.attr('name')]);
        
        events[element.attr('name')] = setTimeout(function() {
            ajax_requests(url, 'PUT', data, false, function(result) {
                console.log(result.status);
            });
        }, 1000);
    });

    $('.subscription-form').on('change', '.pay-date', function(e) {
        if(e.keyCode === 9) { return; }
        
        const id = $('.subscription-form').attr('data-id');
        const url = '/member/' + id;
        const data = $('.subscription-form').serialize();
        
        ajax_requests(url, 'PUT', data, false, function(result) {
            console.log(result.status);
        });
    });

    $('.subscription-form').on('keyup', '.input', function(e) {
        if(e.keyCode === 9 || typeof e.keyCode === 'undefined') { return; }
        
        const element = $(this);
        const id = $('.subscription-form').attr('data-id');
        const url = '/member/' + id;
        const data = $('.subscription-form').serialize();
        
        events[element.attr('name')];
        
        clearTimeout(events[element.attr('name')]);
        
        events[element.attr('name')] = setTimeout(function() {
            ajax_requests(url, 'PUT', data, false, function(result) {
                console.log(result.status);
            });
        }, 1000);
    });

});