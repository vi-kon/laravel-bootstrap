<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">
        <span aria-hidden="true">&times;</span><span class="sr-only">@lang('base.modal.btn.close.content')</span>
    </button>

    <h4 class="modal-title">
        @yield('title')
    </h4>
</div>

<div class="modal-body">
    @yield('body')
</div>

@yield('footer')

@yield('append')