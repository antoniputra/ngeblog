<div class="field">
	<label class="label">Meta Key</label>
	<div class="control">
		{!! Form::text('meta_key', null, ['class' => 'input']) !!}
	</div>
</div>

<div class="field">
	<label class="label">Meta Field Type</label>
	<div class="control">
		<div class="select is-fullwidth">
			{!! Form::select('meta_field', $type_field, null, []) !!}
		</div>
	</div>
</div>

<div class="field">
	<label class="label">Category</label>
	<div class="control">
		<div class="select is-fullwidth">
			{!! Form::select('category_id', $cat_dropdown, null, []) !!}
		</div>
	</div>
</div>

<div class="notification is-info">
	Post Meta configuration only visible on blog post with selected category. If you want this configuration visible for all blog post just <b>left it blank</b>
</div>

<div class="field is-grouped">
	<div class="control">
		<button type="submit" class="button is-primary">Submit</button>
	</div>
	<div class="control">
		<a href="{{ route('ngeblog.category.index') }}" class="button is-link">Cancel</a>
	</div>
</div>
