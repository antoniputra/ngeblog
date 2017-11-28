<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Ngeblog @yield('title', isset($title) ? ' - '. $title : '')</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/ngeblog/css/app.css') }}">
</head>
<body>
	<div class="container">
		<nav class="navbar is-transparent ngeblog-navbar" role="navigation" aria-label="main navigation">
			<div class="navbar-brand">
				<a class="navbar-item" href="http://bulma.io">
					<img src="{{ asset('vendor/ngeblog/img/logo.png') }}" alt="Bulma: a modern CSS framework based on Flexbox">
				</a>

				<button class="button navbar-burger">
					<span></span>
					<span></span>
					<span></span>
				</button>
			</div>
		</nav>

		<div class="ngeblog-content">
			<div class="columns">
				<div class="column is-2">
					@include('ngeblog::admin._sidebar')
				</div>
				<div class="column">
					<div class="section" style="padding: 0px 1.5rem;">
						<nav class="level">
							<div class="level-left">
								<p class="subtitle is-4">{{ $title }}</p>
							</div>
							<div class="level-right">
								@yield('button-title')
							</div>
						</nav>

						@include('ngeblog::admin._alert')

						@yield('content')
					</div>
				</div>
			</div>
		</div>

		<footer class="ngeblog-footer">
			<div class="container">
				<div class="content has-text-centered">
					<p>
						<strong>Ngeblog</strong> by <a href="http://antoniputra.com">Antoni Putra</a>. The <a href="https://github.com/antoniputra/ngeblog">source code</a> is licensed
						<a href="http://opensource.org/licenses/mit-license.php">MIT</a>.
					</p>
				</div>
			</div>
		</footer>
	</div>

	<script src="{{ asset('vendor/ngeblog/js/app.js') }}"></script>
</body>
</html>
