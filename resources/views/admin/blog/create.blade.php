@extends('ngeblog::admin.layout')

@section('content')

	<form class="form-horizontal" method="POST" action="{{ route('ngeblog.blog.store') }}">
		<div class="columns">
			<div class="column is-three-quarters">
				@include('ngeblog::admin.blog._form')
			</div>
		</div>
	</form>

@stop
