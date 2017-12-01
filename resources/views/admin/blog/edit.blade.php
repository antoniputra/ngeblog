@extends('ngeblog::admin.layout')

@section('content')

	{!! Form::model($blog, ['url' => route('ngeblog.blog.update', $blog['id']), 'class' => 'form-horizontal']) !!}
		<div class="columns">
			<div class="column">
				{{ method_field('PUT') }}
				@include('ngeblog::admin.blog._form')
			</div>
		</div>
	{!! Form::close() !!}

@stop
