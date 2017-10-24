{{ csrf_field() }}

<div class="field">
	<label class="label">Title</label>
	<div class="control">
		<input name="title" class="input" type="text" value="{{ old('title', array_get(@$category, 'title')) }}" placeholder="Text input">
	</div>
</div>

<div class="field">
	<label class="label">Description</label>
	<div class="control">
		<textarea name="description" class="textarea" placeholder="Textarea">{{ old('description', array_get(@$category, 'description')) }}</textarea>
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
