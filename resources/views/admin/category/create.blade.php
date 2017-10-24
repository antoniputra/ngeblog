@extends('ngeblog::admin.layout')

@section('content')

	<form class="form-horizontal" method="POST" action="{{ route('ngeblog.category.store') }}">
		<div class="columns">
			<div class="column is-two-thirds">
				@include('ngeblog::admin.category._form')
			</div>
		</div>
	</form>

@stop
