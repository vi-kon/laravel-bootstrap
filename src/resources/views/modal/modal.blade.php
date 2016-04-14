<div id="{{ $id or '' }}" class="modal fade {{$class or ''}}"
     tabindex="-1" role="dialog" aria-labelledby="{{ $labeledBy or '' }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @yield('content')
        </div>
    </div>
</div>

@yield('append')