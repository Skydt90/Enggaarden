<select class="col-md-6s form-control-sm paginate" data-url-id="{{ $urlID }}">
    <option value="25" {{ $amount == 25 ? 'selected' : '' }}>25</option>
    <option value="50" {{ $amount == 50 ? 'selected' : '' }}>50</option>
    <option value="75" {{ $amount == 75 ? 'selected' : '' }}>75</option>
    <option value="100" {{ $amount == 100 ? 'selected' : '' }}>100</option>
</select>