<div class="modal modal-fade add-activity-type" id="add-activity-type">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Ny aktivitet
                </h5>
                <button type="button" class="close" data-dismiss="modal" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="activity_name">Aktivitetsnavn</label>
                            <input class="form-control" type="text" name="activity_type">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary col-md-3 float-right ml-2">Opret</button>
                            <button class="btn btn-danger col-md-3 float-right" data-dismiss="modal">Annullér</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>    
</div>