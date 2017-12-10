@if (sizeof($post_meta) > 0)
	<div class="field">
		<label class="label">Post Meta</label>
		<div class="control">
			<table class="table is-fullwidth is-narrow">
				@foreach ($post_meta as $meta)
					<tr>
						<td>{{$meta['meta_key']}}</td>
						<td>
							@if ($meta['meta_field'] == 'text')
								@include('ngeblog::admin.postmeta.components.text', ['name' => $meta['meta_key'], 'value'=> $meta['meta_value'] ?? null])
							@elseif($meta['meta_field'] == 'textarea')
								@include('ngeblog::admin.postmeta.components.textarea', ['name' => $meta['meta_key'], 'value'=> $meta['meta_value'] ?? null])
							@elseif($meta['meta_field'] == 'date')
								@include('ngeblog::admin.postmeta.components.date', ['name' => $meta['meta_key'], 'value'=> $meta['meta_value'] ?? null])
							@elseif($meta['meta_field'] == 'number')
								@include('ngeblog::admin.postmeta.components.number', ['name' => $meta['meta_key'], 'value'=> $meta['meta_value'] ?? null])
							@endif
						</td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>
@endif
