@extends('ngeblog_public::layout')

@section('content')
    @forelse (Ngeblog::getLatestBlog(5) as $b)
        @include('ngeblog_public::_blog_list', ['blog' => $b])
    @empty
    	<h4>There is no Blog yet.</h4>
    @endforelse
@stop
