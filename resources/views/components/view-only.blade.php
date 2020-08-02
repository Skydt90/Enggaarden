<select class="col-md-6s form-control-sm view-only" data-url-id="{{ $urlID }}">
    <option value="all"              {{ $type === 'all' ? 'selected' : '' }}>Alle</option>
    <option value="is_company,1"     {{ $type === 'is_company,1' ? 'selected' : '' }}>Firmaer</option>
    <option value="is_company,0"     {{ $type === 'is_company,0' ? 'selected' : '' }}>Personer</option>
    <option value="paid"             {{ $type === 'paid' ? 'selected' : '' }}>Betalt</option>
    <option value="unpaid"           {{ $type === 'unpaid' ? 'selected' : '' }}>Ikke betalt</option>
    <option value="is_board,Ja"      {{ $type === 'is_board,Ja' ? 'selected' : '' }}>Bestyrelsen</option>
    <option value="member_type,Primær"   {{ $type === 'member_type,Primær' ? 'selected' : '' }}>Primære</option>
    <option value="member_type,Sekundær" {{ $type === 'member_type,Sekundær' ? 'selected' : '' }}>Sekundære</option>
    <option value="member_type,Ekstern"  {{ $type === 'member_type,Ekstern' ? 'selected' : '' }}>Eksterne</option>
</select>
