@extends('bootstrap::form/group')


@section('field')
    <?php
    $options = [
            'class' => 'form-control',
    ];
    if (isset($index)) {
        $options['data-index'] = $index;
    }
    if (isset($disabled) && $disabled) {
        $options['disabled'] = 'disabled';
    }
    ?>
    {!!app('form')->textarea($name, isset($value) ? $value : null, $options)!!}
@stop