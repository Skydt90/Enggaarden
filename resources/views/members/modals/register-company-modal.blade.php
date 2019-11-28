<div class="modal fade register-modal" id="register-company-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nyt Firma</h5>
                <button type="button" class="close" data-dismiss="modal" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('member.store') }}" method="POST" class="register-form" id="register-company-modal">
                    @csrf
                    <input type="hidden" name="type" value="company">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="company_name">Firmanavn*</label>
                            <input class="form-control" type="text" name="first_name">
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
                    @include('members.partials.address-form')
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