@extends('ngeblog_public::layout')

@section('content')
    @foreach (Ngeblog::getLatestBlog(5) as $b)
        @include('ngeblog_public::_blog_list', ['blog' => $b])
    @endforeach
@stop
