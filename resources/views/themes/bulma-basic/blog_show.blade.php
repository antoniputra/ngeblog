@extends('ngeblog_public::layout')

@section('content')

	<div class="card" style="margin-bottom: 20px;">
		<header class="card-header">
			<p class="card-header-title">
				<a href="{{ route('blog.show', $blog['id']) }}">
					{{ $blog['title'] }}
				</a>
			</p>
		</header>
		<div class="card-content">
			<div class="content">
				{!! $blog['content'] !!}
				<hr>
				<small>{{ $blog['created_at']->toFormattedDateString() }}</small>
			</div>
		</div>
	</div>

@stop
