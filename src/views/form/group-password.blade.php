@extends('bootstrap::form/group')

@section('field')
    @if(isset($index))
        {!!app('form')->password($name, [
            'class'      => 'form-control',
            'data-index' => $index,
        ])!!}
    @else
        {!!app('form')->password($name, [
            'class' => 'form-control',
        ])!!}
    @endif
@overwrite