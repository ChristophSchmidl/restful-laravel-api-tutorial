<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Restful Laravel Api Tutorial

This repository is based on the work of André Castelo's article which you can find <a href="https://www.toptal.com/laravel/restful-laravel-api-tutorial">here</a>.
No additional packages were used to implement this simple API example. I fixed some errors and issues which I disagreed with, namely:

* The ```generateToken``` method on the User model was missing
* The naming convention of the feature tests was not consistent
* ArticleTest did not work properly based on the fact that ```Artisan::call('db:seed')``` was called in the ```setUp``` method of ```TestCase```
* Wrong assertions of statusCodes in ```ArticleTest```
* I did not alter the sqlite entry in ```config/database.php``` but altered ```phpunit.xml``` to use sqlite in-memory and/or a test database.
* Integrated trait ```DatabaseSetup``` into ```TestCase.php``` written by Adam Wathan. See: <a href="https://vimeo.com/191528875">Vimeo</a> and <a href="https://gist.github.com/adamwathan/dd46a8501097942a771925c02bac0111">Github Gist</a>
* ```DatbaseSetup``` has several advantages over ```Illuminate\Foundation\Testing\DatabaseMigrations``` and ```Illuminate\Foundation\Testing\DatabaseTransactions```
	* It checks if phpunit is using an in-memory database or a test database and acts upon this information
	* If it uses in-memory database, then each test method triggers the artisan migrate command which makes tests independent of each other since transactions are not supported here?
	* If it uses a test database, then the migration is only executed once at the beginning of the whole test run. Each test method is then executed inside a transaction to guarantee independence.
	* If you want to use a test database then you only have to create one and alter the information in the phpunit.xml file. No additional changes to ```config/database.php``` or ```.env``` neccessary.


## What could be improved in future versions?

- [] The application currently only supports the login of an account with a single token. That makes it impossible to login from different devices simultaneously.
Using Laravel Passport could solve this problem.
- [] Integrate a pagination and transformation layer like <a href="http://fractal.thephpleague.com/">Fractal</a> or the corresponding <a href="https://github.com/spatie/laravel-fractal">Laravel Fractal Wrapper</a>
