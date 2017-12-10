@section('styles')
	<link href="https://cdn.quilljs.com/1.3.4/quill.snow.css" rel="stylesheet">

	<style>
		.editor, .ql-editor {
			min-height: 200px;
		}
	</style>
@stop

@section('scripts')
<script src="https://cdn.quilljs.com/1.3.4/quill.js"></script>

<!-- Initialize Quill editor -->
<script>
	var quill = new Quill('.editor', {
		theme: 'snow',
		height: 400,
	});

	function theSubmit() {
		var myEditor = document.querySelector('.editor')
		document.querySelector('textarea[name=content]').value = myEditor.children[0].innerHTML;
	}
</script>
@stop

<div class="field">
	<label class="label">Title</label>
	<div class="control">
		{!! Form::text('title', null, ['class' => 'input is-medium']) !!}
	</div>
</div>

<div class="field">
	<label class="label">Category</label>
	<div class="control">
		<div class="select is-fullwidth">
			{!! Form::select('category_id', $cat_dropdown, null, ['dropdown-ajax'=>'true', 'dropdown-ajax-output-id'=>'post-meta-field', 'dropdown-ajax-url'=>route('ngeblog.postmeta.field')]) !!}
		</div>
	</div>
</div>

<div class="field">
	<label class="label">Status</label>
	<div class="control">
		<label class="radio">
			{!! Form::radio('status', 'publish', null) !!}
			Publish
		</label>
		<label class="radio">
			{!! Form::radio('status', 'draft', null) !!}
			Draft
		</label>
	</div>
</div>
<hr />

<div class="field">
	<label class="label">Content</label>
	<div class="control">
		{!! Form::hidden('editor_type', 'quill') !!}
		{!! Form::textarea('content', null, ['style' => 'display: none;']) !!}
		<div class="editor">{!! old('content', @$blog['content']) !!}</div>
	</div>
</div>

<div id="post-meta-field">
	@if (isset($post_meta) && sizeof($post_meta) > 0)
		@include('ngeblog::admin.postmeta._field', ['post_meta' => $post_meta])
	@endif
</div>


{{-- <div class="field">
	<label class="label">Content</label>
	<div class="control">
		<markdown name="content" value="{{ old('content', @$blog['content']) }}"></markdown>
	</div>
</div> --}}

<br/><hr/>

<div class="field is-grouped">
	<div class="control">
		<button type="submit" class="button is-primary" onclick="theSubmit()">Submit</button>
	</div>
	<div class="control">
		<a href="{{ route('ngeblog.blog.index') }}" class="button is-link">Cancel</a>
	</div>
</div>
