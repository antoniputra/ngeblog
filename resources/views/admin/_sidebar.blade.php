<aside class="menu ngeblog-sidebar">
	<p class="menu-label">
		Main Menu
	</p>
	<ul class="menu-list">
		<li><a href="{{ route('ngeblog.dashboard') }}"
			@if(str_contains(Route::currentRouteName(), '.dashboard')) class="is-active" @endif>
			<span class="icon is-medium">
				<i class="ion-ios-home-outline"></i>
			</span>
			Dashboard
		</a></li>
		<li><a href="{{ route('ngeblog.category.index') }}"
			@if(str_contains(Route::currentRouteName(), '.category')) class="is-active" @endif>
			<span class="icon is-medium">
				<i class="ion-ios-pricetag-outline"></i>
			</span>
			Category
		</a></li>
		<li><a href="{{ route('ngeblog.blog.index') }}"
			@if(str_contains(Route::currentRouteName(), '.blog')) class="is-active" @endif>
			<span class="icon is-medium">
				<i class="ion-ios-list-outline"></i>
			</span>
			Blog
		</a></li>
		{{-- <li><a href="#">
			<span class="icon is-medium">
				<i class="ion-ios-alarm-outline"></i>
			</span>
			Schedule
		</a></li> --}}
	</ul>
</aside>
