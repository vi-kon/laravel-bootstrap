@extends('bootstrap::form/group')

@section('field')
    <?php
    $options = [
            'class'    => 'form-control multiple',
            'multiple' => 'multiple',
    ];
    if (isset($index)) {
        $options['data-index'] = $index;
    }
    if (isset($disabled) && $disabled) {
        $options['disabled'] = 'disabled';
    }
    ?>
    {!!app('form')->select($name, isset($value) ? $value : null, $options)!!}
@overwrite