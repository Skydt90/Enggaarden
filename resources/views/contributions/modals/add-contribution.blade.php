<div class="modal fade add-contribution" id="add-contribution">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Nyt støttebidrag
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('contribution.store') }}" method="post" class="contribution-form">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="activity_type">Aktivitet</label>
                                <select class="form-control" name="activity_type">
                                    @foreach ($activity_types as $activity_type)
                                        <option value="{{ $activity_type->activity_type }}">
                                            {{ $activity_type->activity_type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="amount">Beløb</label>
                                <input class="form-control" type="number" step="0.01" name="amount">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="amount">Betalingsdato</label>
                                <input class="form-control" type="date" name="pay_date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary col-md-2 float-right ml-2">Opret</button>
                                <button class="btn btn-danger col-md-2 float-right" data-dismiss="modal">Annullér</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>    
    </div>