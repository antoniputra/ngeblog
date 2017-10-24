<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ngeblog @yield('title', isset($title) ? ' - '. $title : '')</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/ngeblog/css/site.css') }}">
</head>
<body>
	<div class="container">
		<nav class="navbar is-transparent ngeblog-navbar" role="navigation" aria-label="main navigation">
			<div class="navbar-brand">
				<a class="navbar-item" href="{{ route('blog.index') }}">
					<img src="http://bulma.io/images/bulma-logo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
				</a>

				<button class="button navbar-burger">
					<span></span>
					<span></span>
					<span></span>
				</button>
			</div>
		</nav>
		<br/><br/>

		<div class="columns">
			<div class="column is-3">
				<aside class="menu ngeblog-sidebar">
					<ul class="menu-list">
    					<li><a href="{{ route('blog.index') }}">Home</a></li>
					</ul>
					<p class="menu-label">
						Category
					</p>
					<ul class="menu-list">
						@foreach (Ngeblog::getLatestCategory() as $cat)
							<li>
								<a href="{{ route('category.show', $cat['id']) }}"
									@if(str_contains(Route::currentRouteName(), '.dashboard')) class="is-active" @endif>
									<b>{{ $cat['title'] }}</b> <small>({{ $cat['blogs_count'] }} blog)</small>
								</a>
							</li>
						@endforeach
					</ul>
				</aside>
			</div>
			<div class="column">
				@yield('content')
			</div>
		</div>
	</div>
</body>
</html>
