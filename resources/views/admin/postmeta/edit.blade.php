@extends('ngeblog::admin.layout')

@section('content')

	{!! Form::model($category, ['url' => route('ngeblog.category.update', $category['id']), 'class' => 'form-horizontal']) !!}
		<div class="columns">
			<div class="column is-two-thirds">
				{!! method_field('PUT') !!}
				@include('ngeblog::admin.category._form')
			</div>
		</div>
	{!! Form::close() !!}

@stop
