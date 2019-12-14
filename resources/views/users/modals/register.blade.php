<div class="modal fade register-modal" id="register-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ny Bruger</h5>
                <button type="button" class="close" data-dismiss="modal" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('register') }}" method="POST" class="register-form" id="register-user-modal">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="username">Brugernavn*</label>
                            <input class="form-control" type="text" name="username">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="user_type">Brugertype</label>
                            <select class="form-control" name="user_type">
                                @foreach (App\Models\User::USER_TYPES as $user_type)
                                    <option value="{{ $user_type }}">
                                        {{ $user_type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">Kodeord*</label>
                            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password-confirm">Bekræft Kodeord*</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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