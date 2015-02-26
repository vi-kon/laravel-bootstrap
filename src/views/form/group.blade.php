<div class="form-group{{$errors->has($name) ? ' has-error' : ''}} form-group-field-{{$name}}">

    <label class="control-label col-sm-{!!$labelSize or 4!!}" for="{{$name}}">
        @lang($label)
    </label>

    <div class="col-sm-{{isset($labelSize) ? 12 - $labelSize : 8}}">
        <div class="form-group-field">
            @yield('field')
        </div>

        @if($errors->has($name))
            <div class="help-block error-block">
                {!!$errors->first($name)!!}
            </div>
        @endif

        @if(isset($help))
            <div class="help-block">
                {!!$help!!}
            </div>
        @endif
    </div>

</div>