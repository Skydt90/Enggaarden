<div id="delete-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="row">
                <div class="col md-12">
                    <h3 class="text-center mt-3 mb-n1">Advarsel</h3>                      
                </div>
            </div>
            <div class="modal-body text-center">
                <p class="lead">Ønsker du virkelig at slette {{ $member->name ?? '' }} ?</p>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-danger col-md-2 mr-2 mt-2" data-dismiss="modal">Nej</button>
                        <button type="button" class="member-delete-button btn btn-success col-md-2 mt-2" data-id="{{ $member->id ?? 1 }}" data-dismiss="modal" >Ja</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
