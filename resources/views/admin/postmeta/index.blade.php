@extends('ngeblog::admin.layout')

@section('button-title')
	<a href="{{ route('ngeblog.postmeta.create') }}" class="button is-primary">
		<span class="icon">
			<i class="ion-plus"></i>
		</span>
		<span>Create</span>
	</a>
@stop

@section('content')
	@if (sizeof($configurations) < 1)
		<article class="message">
			<div class="message-body">
				There is no configurations yet. <a href="{{ route('ngeblog.postmeta.create') }}" class="">Create new</a>
			</div>
		</article>
	@else
		<table class="table is-bordered is-fullwidth">
			<thead>
				<tr>
					<th>Meta Key</th>
					<th>Meta Field Type</th>
					<th>Category Id</th>
					<th>Category Name</th>
					<th style="width: 20%;">Action</th>
				</tr>
			</thead>
			<tbody>

				@foreach ($configurations as $key=>$config)
					<tr>
						<td>{{ $config['meta_key'] }}</td>
						<td>{{ $config['meta_field'] }}</td>
						<td>{{ ($config['category_id'] == 0)?'-' : $config['category_id'] }}</td>
						<td>{{ ($config['category_id'] == 0)?'-' : $config['category_title'] }}</td>
						<td>
							<a href="{{ route('ngeblog.postmeta.edit', $key) }}" class="button is-small">
								<span class="icon"><i class="ion-edit"></i></span>
								<span>Edit</span>
							</a>
							<a href="{{ route('ngeblog.postmeta.destroy', $key) }}"
							class="button is-danger is-small"
							data-method="delete"
							data-confirm="Are you sure prend?">
								<span class="icon"><i class="ion-ios-trash-outline"></i></span>
								<span>Delete</span>
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

	@endif
@stop
