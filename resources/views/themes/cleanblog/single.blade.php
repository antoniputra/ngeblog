@extends('ngeblog_themes::cleanblog.layout')

@section('header')
	<header class="masthead" style="background-image: url('img/post-bg.jpg')">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-10 mx-auto">
					<div class="post-heading">
						<h1>{{ $blog['title'] }}</h1>
						{{-- <h2 class="subheading">Problems look mighty small from 150 miles up</h2> --}}
						<span class="meta">
							@if ($blog['user'])
								Posted by
								<u>{{ $blog['user']['name'] }}</u>
							@endif
							on {{ $blog['created_at']->format('F j, Y') }}
						</span>
					</div>
				</div>
			</div>
		</div>
	</header>
@stop

@section('content')

<article>
	{!! $blog['content'] !!}
</article>

@stop
