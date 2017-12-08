@extends('ngeblog::admin.layout')

@section('content')

	{!! Form::open(['url' => route('ngeblog.postmeta.store'), 'class' => 'form-horizontal']) !!}
		<div class="columns">
			<div class="column is-two-thirds">
				@include('ngeblog::admin.postmeta._form')
			</div>
		</div>
	{!! Form::close() !!}

@stop
