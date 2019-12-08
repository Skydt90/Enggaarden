<nav>
    <ul class="pagination pagination-sm">
        @for ($i = 1; $i <= $paginated->lastPage(); $i++)
            <li class="page-item {{ $page == $i ? 'active' : '' }}">
                <a href="{{ route($index) . '?page=' . $i . '&amount=' . $amount }}" class="page-link">{{ $i }}</a> 
            </li>
        @endfor
    </ul>
</nav>