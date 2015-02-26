@extends('bootstrap::form/group')


@section('field')
    @if(isset($index))
        {!!app('form')->text($name, isset($value) ? $value : null, [
            'class'      => 'form-control',
            'data-index' => $index,
        ])!!}
    @else
        {!!app('form')->text($name, isset($value) ? $value : null, [
            'class' => 'form-control',
        ])!!}
    @endif
@overwrite