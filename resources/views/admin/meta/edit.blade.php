@extends('ngeblog::admin.layout')

@section('content')

	{!! Form::model($meta, ['method' => 'PUT', 'url' => route('ngeblog.meta.update', $meta['id']), 'class' => 'form-horizontal']) !!}
		<div class="columns">
			<div class="column is-two-thirds">
				@include('ngeblog::admin.meta._form')
			</div>
		</div>
	{!! Form::close() !!}

@endsection
