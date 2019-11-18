<div class="modal fade" id="register-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mb-n2">Nyt Medlem</h5>
                <button type="button" class="close" data-dismiss="modal" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('member.store') }}" method="POST" class="register-form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="first_name">Fornavn*</label>
                            <input class="form-control" type="text" name="first_name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name">Efternavn</label>
                            <input class="form-control" type="text" name="last_name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email*</label>
                            <input class="form-control" type="email" name="email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone_number">Mobil*</label>
                            <input class="form-control" type="number" name="phone_number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="member_type">Medlemstype</label>
                            <select class="form-control" name="member_type">
                                @foreach (App\Models\Member::MEMBER_TYPES as $member_type)
                                    <option value="{{ $member_type }}">
                                        {{ $member_type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="is_board col-md-6">Er personen bestyrelsesmedlem?</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_board" value="Nej" checked>
                                <label class="form-check-label" for="no">Nej</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_board" value="Ja">
                                <label class="form-check-label" for="yes">Ja</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="submit" class="add btn btn-primary col-md-3 float-right ml-2">Opret</button>
                            <button class="btn btn-danger col-md-3 float-right" data-dismiss="modal">Annullér</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>