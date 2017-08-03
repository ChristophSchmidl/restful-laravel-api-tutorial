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
* ArticeTest did not work properly based on the fact that ```Artisan::call('db:seed');``` was called in the ```setUp``` method of ```TestCase```
* Wrong assertions of statusCodes in ```ArticleTest```
* I did not alter the sqlite entry in ```cofig/database.php``` but added a new entry called ```testing``` which uses sqlite in memory just for testing purposes.
* ```phunit.xml``` now uses ```<env name="DB_CONNECTION" value="testing"/>```


## What could be improved in future versions?

- [] The application currently only supports the login of an account with a single token. That makes it impossible to login from different devices simultaneously.
Using Laravel Passport could solve this problem.
- [] Integrate a pagination and transformation layer like <a href="http://fractal.thephpleague.com/">Fractal</a> or the corresponding <a href="https://github.com/spatie/laravel-fractal">Laravel Fractal Wrapper</a>
