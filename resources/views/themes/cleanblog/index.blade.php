@extends('ngeblog_themes::cleanblog.layout')

@section('header')
	<!-- Page Header -->
	<header class="masthead" style="background-image: url('{{ asset('vendor/ngeblog/themes/cleanblog/img/home-bg.jpg') }}')">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-10 mx-auto">
					<div class="site-heading">
						<h1>Clean Blog</h1>
						<span class="subheading">A Blog Theme by Start Bootstrap</span>
					</div>
				</div>
			</div>
		</div>
	</header>
@stop

@section('content')
@forelse ($blogs as $blog)
    <div class="post-preview">
		<a href="{{ route('nb.blog.show', $blog['slug']) }}">
			<h2 class="post-title">
				{{ $blog['title'] }}
			</h2>
			<h3 class="post-subtitle">
				{!! substr(strip_tags($blog['content']), 0, 100) !!}...
			</h3>
		</a>
		<p class="post-meta">
			@if ($blog['user'])
				Posted by
				<u>{{ $blog['user']['name'] }}</u>
			@endif
			on {{ $blog['created_at']->format('F j, Y') }}
		</p>
	</div>
	<hr>
@empty
    <p>No blogs</p>
@endforelse

<br/>
<div class="row">
	<div class="col-md-4 offset-md-4">
		{!! $blogs->render('pagination::simple-bootstrap-4') !!}
	</div>
</div>

@stop
