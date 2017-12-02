<p align="center"><a href="https://github.com/antoniputra/ngeblog" target="_blank"><img src="https://raw.githubusercontent.com/antoniputra/ngeblog/master/publishable/assets/img/logo.png" width="300px"></a></p>

<p align="center">
	<a href="https://travis-ci.org/antoniputra/ngeblog"><img src="https://travis-ci.org/antoniputra/ngeblog.svg?branch=master" alt="Build Status"></a>
	<a href="https://packagist.org/packages/antoniputra/ngeblog"><img src="https://poser.pugx.org/antoniputra/ngeblog/v/stable" alt="Latest Stable Version"></a>
	<!-- <a href="https://packagist.org/packages/antoniputra/ngeblog"><img src="https://poser.pugx.org/antoniputra/ngeblog/downloads.svg?format=flat" alt="Total Downloads"></a> -->
	<a href="https://packagist.org/packages/antoniputra/ngeblog"><img src="https://poser.pugx.org/antoniputra/ngeblog/license.svg" alt="License"></a>
</p>

# Ngeblog

It just quickstart to have simple blogging system for your existing laravel application. It will give you `Blogs` and `Categories` out of the box. **Ngeblog** also provides a simple admin panel using [Bulma](https://bulma.io/).

### Screenshot
<p align="center">
	<a href="https://raw.githubusercontent.com/antoniputra/ngeblog/master/public/img/screenshot.png" target="_blank">
		<img src="https://raw.githubusercontent.com/antoniputra/ngeblog/master/publishable/assets/img/screenshot.png" alt="Ngeblog Screenshot">
	</a>
</p>


## Installation

1. `composer require antoniputra/ngeblog`

2. `php artisan ngeblog:install`

3. You done!


#### Protect the admin panel

Once this package already installed correctly, by default it will provide admin panel at `/ngeblog` with no protection. You can add your own protection like below:

```php
// routes/web.php

Ngeblog::auth(function ($request) {
    // your protection logic...

    return auth()->check();
});
```


## Credits

- Thanks to [@arryanggaputra](https://github.com/arryanggaputra) for the _nice looking logo_.


## License

**Ngeblog** is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)