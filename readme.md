<p align="center"><a href="https://github.com/antoniputra/ngeblog" target="_blank"><img src="https://raw.githubusercontent.com/antoniputra/ngeblog/main/art/logo.png" width="300px"></a></p>

<p align="center">
	<a href="https://github.com/antoniputra/ngeblog/actions/workflows/tests.yml"><img alt="GitHub Actions Workflow Status" src="https://img.shields.io/github/actions/workflow/status/antoniputra/ngeblog/tests.yml"></a>
	<!-- <a href="https://packagist.org/packages/antoniputra/ngeblog"><img src="https://poser.pugx.org/antoniputra/ngeblog/v/stable" alt="Latest Stable Version"></a> -->
	<!-- <a href="https://packagist.org/packages/antoniputra/ngeblog"><img src="https://poser.pugx.org/antoniputra/ngeblog/downloads.svg?format=flat" alt="Total Downloads"></a> -->
	<a href="https://packagist.org/packages/antoniputra/ngeblog"><img src="https://poser.pugx.org/antoniputra/ngeblog/license.svg" alt="License"></a>
</p>

# Ngeblog

It helps you to quickly set up a simple **Blogging System** for your existing or brand-new Laravel application. Ngeblog provides a simple and elegant admin panel built with `Vue` and `Daisy UI` as a **Modern SPA App**.

### Features

- BlogPost with [Tiptap Editor](https://tiptap.dev).
- Tagging feature.
- Dashboard.
- Starter Page.
- and more...

### Screenshot

#### Preview of Dashboard page.
<p align="center">
	<a href="https://raw.githubusercontent.com/antoniputra/ngeblog/main/art/preview-dashboard.png" target="_blank">
		<img src="https://raw.githubusercontent.com/antoniputra/ngeblog/main/art/preview-dashboard.png" alt="Ngeblog Screenshot">
	</a>
</p>


#### Preview of Starter page.
<p align="center">
	<a href="https://raw.githubusercontent.com/antoniputra/ngeblog/main/art/preview-starter-page.png" target="_blank">
		<img src="https://raw.githubusercontent.com/antoniputra/ngeblog/main/art/preview-starter-page.png" alt="Ngeblog Screenshot">
	</a>
</p>


## Installation

```bash
composer require antoniputra/ngeblog
```

Resolve the installation:
```bash
php artisan ngeblog:install
```


## Configuration

After installation, by default will provide an admin panel at `https://your-web.test/ngeblog` and only available for authenticated user.

Follow below section to customize as you wish.

### Change Admin Panel URL

Go to your `.env` and put new key value:
```env
NGEBLOG_PATH='blog-admin-panel'
```

### Protect Admin Panel

You can add your own protection logic like below:

```php
// App/Providers/AppServiceProvider.php

Gate::define('accessNgeblogAdmin', function ($user) {
	return in_array($user->email, [
		// list of whitelisted emails...
	]);
});
```


## Contributing Guide

I glad to see you here on this section. Whether you're a seasoned developer or new to open source, your participation is valuable. Let's collaborate and learn together! 🚀

Follow the steps below to get started.

### Back-end Dependencies:
- Laravel 11
- Pest, Testbench

### Front-end Dependencies:
- Vue 3 & VueRouter (script-setup)
- Tailwind & DaisyUI.
- Tiptap Editor, HeadlessUI, VueUse, FloatingUI.

### Steps to Contribute:
1. Fork and clone the repo, then navigate to the project folder.
2. Install dependencies: `composer install` & `npm install`.
3. Run the app: `composer serve`.

### Asset Building:
- For development (rebuilds on save):
  ```bash
  npm run watch
  ```
- Before pushing code (minified version):
  ```bash
  npm run build
  ```

## Credits

- Thanks to [@arryanggaputra](https://github.com/arryanggaputra) for the nice looking logo.


## License

**Ngeblog** is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

Built with love by @antoni_putra12 and made better by you.
