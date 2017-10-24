{{ csrf_field() }}

<div class="field">
	<label class="label">Title</label>
	<div class="control">
		<input name="title" class="input" type="text" value="{{ old('title', array_get(@$blog, 'title')) }}" placeholder="Text input">
	</div>
</div>

<div class="field">
	<label class="label">Category</label>
	<div class="control">
		<div class="select is-fullwidth">
			<select name="category_id">
				<option>Select Category</option>
				@foreach ($cat_dropdown as $value => $display)
					<option
						value="{{ $value }}"
						@if($value == old('category_id', array_get(@$blog, 'category_id'))) selected @endif
						>{{ $display }}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>

<div class="field">
	<label class="label">Content</label>
	<div class="control">
		<textarea name="content" class="textarea" rows="10" placeholder="Textarea">{{ old('content', array_get(@$blog, 'content')) }}</textarea>
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
