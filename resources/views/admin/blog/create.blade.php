@extends('ngeblog::admin.layout')

@section('content')

	{!! Form::open(['url' => route('ngeblog.blog.store'), 'class' => 'form-horizontal']) !!}
		<div class="columns">
			<div class="column is-three-quarters">
				@include('ngeblog::admin.blog._form')
			</div>
		</div>
	{!! Form::close() !!}

@stop
