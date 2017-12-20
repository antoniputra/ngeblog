@extends('ngeblog::admin.layout')

@section('button-title')
	<a href="{{ route('ngeblog.meta.create') }}" class="button is-primary">
		<span class="icon">
			<i class="ion-plus"></i>
		</span>
		<span>Create</span>
	</a>
@stop

@section('content')
	@if ($metas->isEmpty())
		<article class="message">
			<div class="message-body">
				There is no data yet. <a href="{{ route('ngeblog.meta.create') }}" class="">Create new</a>
			</div>
		</article>
	@else
		<table class="table is-bordered is-fullwidth">
			<thead>
				<tr>
					<th style="width: 5%;">No</th>
					<th style="width: 25%;">Meta Field</th>
					<th>Meta Key</th>
					<th>Blog Category</th>
					<th style="width: 20%;">Action</th>
				</tr>
			</thead>
			<tbody>
				@php
				$no = $metas->firstItem();
				@endphp
				@foreach ($metas as $m)
				<tr>
					<td>{{ $no++ }}</td>
					<td>{{ $m['meta_field'] }}</td>
					<td>{{ $m['meta_default_key'] }}</td>
					<td>{!! !empty($m['category']) ? $m['category']['title'] : "<span class='tag is-primary'>All Blog</span>" !!}</td>
					<td>
						<a href="{{ route('ngeblog.meta.edit', $m['id']) }}" class="button is-small">
							<span class="icon"><i class="ion-edit"></i></span>
							<span>Edit</span>
						</a>
						<a href="{{ route('ngeblog.meta.destroy', $m['id']) }}"
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

		{!! $metas->links('ngeblog::pagination-bulma') !!}
	@endif
@endsection
