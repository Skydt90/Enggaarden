<div class="modal fade" id="register-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nyt Medlem</h5>
                <button type="button" class="close" data-dismiss="modal" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="first_name">Fornavn</label>
                            <input class="form-control" type="text" value="{{ old('first_name', $member->first_name ?? null) }}" name="first_name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name">Efternavn</label>
                            <input class="form-control" type="text" value="{{ old('last_name', $member->last_name ?? null) }}" name="last_name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" value="{{ old('email', $member->email ?? null) }}" name="email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone_number">Telefon</label>
                            <input class="form-control" type="number" value="{{ old('phone_number', $member->phone_number ?? null) }}" name="phone_number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="member_type">Medlemstype</label>
                            <select class="form-control">
                                <option>Primær</option>
                                <option>Sekundær</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="is_board col-md-6">Er personen bestyrelsesmedlem?</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="radio_member" value="Ja">
                                <label class="form-check-label" for="yes">Ja</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="radio_member" value="Nej">
                                <label class="form-check-label" for="no">Nej</label>
                            </div>
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