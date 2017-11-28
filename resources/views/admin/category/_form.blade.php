<div class="field">
	<label class="label">Title</label>
	<div class="control">
		{!! Form::text('title', null, ['class' => 'input']) !!}
	</div>
</div>

<div class="field">
	<label class="label">Description</label>
	<div class="control">
		{!! Form::textarea('description', null, ['class' => 'textarea', 'rows' => 4]) !!}
	</div>
</div>

<div class="field is-grouped">
	<div class="control">
		<button type="submit" class="button is-primary">Submit</button>
	</div>
	<div class="control">
		<a href="{{ route('ngeblog.category.index') }}" class="button is-link">Cancel</a>
	</div>
</div>
