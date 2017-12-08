@extends('ngeblog::admin.layout')

@section('content')

	{!! Form::model($configuration, ['url' => route('ngeblog.postmeta.update', $id), 'class' => 'form-horizontal']) !!}
		<div class="columns">
			<div class="column is-two-thirds">
				{!! method_field('PUT') !!}
				@include('ngeblog::admin.postmeta._form')
			</div>
		</div>
	{!! Form::close() !!}

@stop
