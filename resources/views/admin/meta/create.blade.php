@extends('ngeblog::admin.layout')

@section('content')

	{!! Form::open(['method' => 'POST', 'url' => route('ngeblog.meta.store'), 'class' => 'form-horizontal']) !!}
		<div class="columns">
			<div class="column is-two-thirds">
				@include('ngeblog::admin.meta._form')
			</div>
		</div>
	{!! Form::close() !!}

@endsection
