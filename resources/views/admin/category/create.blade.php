@extends('ngeblog::admin.layout')

@section('content')

	{!! Form::open(['url' => route('ngeblog.category.store'), 'class' => 'form-horizontal']) !!}
		<div class="columns">
			<div class="column is-two-thirds">
				@include('ngeblog::admin.category._form')
			</div>
		</div>
	{!! Form::close() !!}

@stop
