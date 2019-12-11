<select class="col-md-6s form-control-sm view-only" data-url-id="{{ $urlID }}">
    <option value="all"       {{ $type === 'all' ? 'selected' : '' }}>Alle</option>
    <option value="companies" {{ $type === 'companies' ? 'selected' : '' }}>Firmaer</option>
    <option value="people"    {{ $type === 'people' ? 'selected' : '' }}>Personer</option>
    <option value="paid"      {{ $type == 'paid' ? 'selected' : '' }}>Betalt</option>
    <option value="unpaid"    {{ $type == 'unpaid' ? 'selected' : '' }}>Ikke betalt</option>
</select>