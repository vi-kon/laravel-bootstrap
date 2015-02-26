@extends('bootstrap::form/group')

@section('field')
    @if(isset($index))
        {{app('form')->select($name, $list, isset($selected) ? $selected : null, [
            'class'      => 'form-control multiple',
            'multiple'   => 'multiple',
            'data-index' => $index,
        ])}}
    @else
        {{app('form')->select($name, $list, isset($selected) ? $selected : null, [
            'class'    => 'form-control multiple',
            'multiple' => 'multiple',
        ])}}
    @endif
@overwrite