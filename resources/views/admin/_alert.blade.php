@if (isset($errors) && count($errors) > 0)
	<div class="notification is-danger">
		<button class="delete"></button>
		<h3 class="title is-6">Whoops something went wrong!</h3>

		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@elseif(session('message'))
	<div class="notification {{ session('message.type') }}">
		<button class="delete"></button>
		{{ session('message.content') }}
	</div>
@endif
