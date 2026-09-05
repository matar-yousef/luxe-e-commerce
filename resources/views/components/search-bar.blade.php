@props(['placeholder' => 'Search here...','width' => '400px'])


<form action="{{ url()->current() }}" method="GET" class="mb-0">
    @if(request('trash'))
    <input type="hidden" name="trash" value="true">
    @endif
    <div class="input-group input-group-sm" style="width: 400px;">
        <input type="text" name="search" class="form-control"
            placeholder="Search here..." value="{{ request('search') }}">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search"></i>
            </button>
            @if(request('search'))
            <a href="{{ url()->current() . (request('trash') ? '?trash=true' : '') }}"
                class="btn btn-default">
                <i class="fas fa-times"></i>
            </a>
            @endif
        </div>
    </div>
</form>