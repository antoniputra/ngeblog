@extends('ngeblog::admin.layout')

@section('content')

	<form class="form-horizontal" method="POST" action="{{ route('ngeblog.category.update', $category['id']) }}">
		<div class="columns">
			<div class="column is-two-thirds">
				{!! method_field('PUT') !!}
				@include('ngeblog::admin.category._form')
			</div>
		</div>
	</form>

@stop
