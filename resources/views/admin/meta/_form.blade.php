<div class="field">
	<label class="label">Meta Field Type</label>
	<div class="control">
		<div class="select is-fullwidth">
			{!! Form::select('meta_field', $fields_dropdown, null, []) !!}
		</div>
	</div>
</div>

<div class="field">
	<label class="label">Meta Key</label>
	<div class="control">
		{!! Form::text('meta_default_key', null, ['class' => 'input']) !!}
	</div>
</div>

<div class="field">
	<label class="label">Meta Default Value</label>
	<div class="control">
		{!! Form::textarea('meta_default_value', null, ['class' => 'textarea', 'rows' => 3]) !!}
	</div>
</div>

<div class="field">
	<label class="label">Category</label>
	<div class="control">
		<div class="select is-fullwidth">
			{!! Form::select('category_id', $category_dropdown, null, []) !!}
		</div>
	</div>
</div>

<div class="notification is-info">
	Post Meta configuration only visible on blog post with selected category. If you want this configuration visible for all blog post just <b>left category blank</b>
</div>

<div class="field is-grouped">
	<div class="control">
		<button type="submit" class="button is-primary">Submit</button>
	</div>
	<div class="control">
		<a href="{{ route('ngeblog.meta.index') }}" class="button is-link">Cancel</a>
	</div>
</div>
