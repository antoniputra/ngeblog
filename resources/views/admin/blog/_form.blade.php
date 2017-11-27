<div class="field">
	<label class="label">Title</label>
	<div class="control">
		{!! Form::text('title', null, ['class' => 'input']) !!}
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

<div class="field">
	<label class="label">Content</label>
	<div class="control">
		{!! Form::textarea('content', null, ['class' => 'textarea', 'rows' => 4]) !!}
	</div>
</div>

<div class="field is-grouped">
	<div class="control">
		<button type="submit" class="button is-primary">Submit</button>
	</div>
	<div class="control">
		<a href="{{ route('ngeblog.blog.index') }}" class="button is-link">Cancel</a>
	</div>
</div>
