@extends('ngeblog::admin.layout')

@section('button-title')
	<a href="{{ route('ngeblog.category.create') }}" class="button is-primary">
		<span class="icon">
			<i class="ion-plus"></i>
		</span>
		<span>Create</span>
	</a>
@stop

@section('content')
	@if ($categories->isEmpty())
		<article class="message">
			<div class="message-body">
				There is no data yet. <a href="{{ route('ngeblog.category.create') }}" class="">Create new</a>
			</div>
		</article>
	@else
		<table class="table is-bordered is-fullwidth">
			<thead>
				<tr>
					<th style="width: 5%;">No</th>
					<th style="width: 50%;">Title</th>
					<th>Total Blog</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@php
				$no = $categories->firstItem();
				@endphp
				@foreach ($categories as $cat)
					<tr>
						<td>{{ $no++ }}</td>
						<td>{{ $cat['title'] }}</td>
						<td>{{ $cat['blogs_count'] }}</td>
						<td>
							<a href="{{ route('ngeblog.category.edit', $cat['id']) }}" class="button is-small">
								<span class="icon"><i class="ion-edit"></i></span>
								<span>Edit</span>
							</a>
							{!! \Form::link('<span>Delete</span>', 'DELETE',
								route('ngeblog.category.destroy', $cat['id']),
								[
									'class' => 'button is-danger is-small',
									'icon' => '<span class="icon"><i class="ion-ios-trash-outline"></i></span>',
								],
								'Are you sure?'
							) !!}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		{!! $categories->links('ngeblog::pagination-bulma') !!}
	@endif
@stop
