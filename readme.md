<p align="center"><a href="https://github.com/antoniputra/ngeblog" target="_blank"><img src="https://raw.githubusercontent.com/antoniputra/ngeblog/main/art/logo.png" width="300px"></a></p>

<p align="center">
	<!-- <a href="https://travis-ci.org/antoniputra/ngeblog"><img src="https://travis-ci.org/antoniputra/ngeblog.svg?branch=master" alt="Build Status"></a> -->
	<!-- <a href="https://packagist.org/packages/antoniputra/ngeblog"><img src="https://poser.pugx.org/antoniputra/ngeblog/v/stable" alt="Latest Stable Version"></a> -->
	<!-- <a href="https://packagist.org/packages/antoniputra/ngeblog"><img src="https://poser.pugx.org/antoniputra/ngeblog/downloads.svg?format=flat" alt="Total Downloads"></a> -->
	<a href="https://packagist.org/packages/antoniputra/ngeblog"><img src="https://poser.pugx.org/antoniputra/ngeblog/license.svg" alt="License"></a>
</p>

# Ngeblog

It's quickstart to have simple **Blogging System** for your existing laravel application. It will give you `Blogs` and `Tags` out of the box. **Ngeblog** also provides a simple admin panel built with Vue SPA.

### Screenshot
<p align="center">
	<a href="https://raw.githubusercontent.com/antoniputra/ngeblog/main/art/sample-1.png" target="_blank">
		<img src="https://raw.githubusercontent.com/antoniputra/ngeblog/main/art/sample-1.png" alt="Ngeblog Screenshot">
	</a>
</p>


## Installation

1. `composer require antoniputra/ngeblog`
2. `php artisan vendor:publish`
3. `php artisan migrate`
4. You done!


## Configuration

Once this package already installed, by default it will provide admin panel at `/ngeblog` with no protection. You can add your own protection like below:

```php
// App/Providers/AppServiceProvider.php

Gate::define('accessNgeblogAdmin', function ($user) {
	return in_array($user->email, [
		'akiddcode@gmail.com',
		// ...
	]);
});
```


## Credits

- Thanks to [@arryanggaputra](https://github.com/arryanggaputra) for the _nice looking logo_.


## License

**Ngeblog** is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)