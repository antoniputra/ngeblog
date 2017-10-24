@extends('ngeblog_public::layout')

@section('content')
    @foreach ($category['blogs'] as $b)
        @include('ngeblog_public::_blog_list', ['blog' => $b])
    @endforeach
@stop
