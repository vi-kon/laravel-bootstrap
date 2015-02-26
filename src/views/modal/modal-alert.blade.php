@extends('bootstrap::modal/modal')


@section('title')
    {{$title or ''}}
@stop


@section('body')
    <div class="alert @section('type'){{$type or 'alert-info'}}@show text-justify">
        @section('message')
            {{$message or ''}}
        @show
    </div>
@overwrite
