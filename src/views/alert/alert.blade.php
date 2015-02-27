<div class="alert alert-{{$type}}@if(isset($dismissible) && $dismissible) alert-dismissible @endif" role="alert">
    @if(isset($dismissible) && $dismissible)
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span
                    class="sr-only">Close</span></button>
    @endif
    {{$message}}
</div>