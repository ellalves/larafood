<form action="{{ $route ?? '' }}" method="post" class="container form form-inline">
    @if ($route)
        <div class="form-group mx-sm-3 mb-2">
            @csrf
            <input type="text" name="filter" placeholder="Filtrar" value="{{ $filters['filter'] ?? '' }}" class="form-control">
            <button type="submit" class="btn btn-dark">
                <i class="fas fa-search"></i> 
            </button>
        </div>
    @endif

    @if (!empty($add))
        <a href="{{ $add ?? '#' }}" class="btn btn-success mb-2"> <i class="fas fa-{{ $icon ?? 'plus-square'}}"></i> {{ $label ?? 'NOVO' }} </a>
    @endif
</form>