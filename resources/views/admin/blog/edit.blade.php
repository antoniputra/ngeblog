@extends('ngeblog::admin.layout')

@section('content')

	<form class="form-horizontal" method="POST" action="{{ route('ngeblog.blog.update', $blog['id']) }}">
		<div class="columns">
			<div class="column is-three-quarters">
				{{ method_field('PUT') }}
				@include('ngeblog::admin.blog._form')
			</div>
		</div>
	</form>

@stop
