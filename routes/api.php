<?php

use App\Article;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/*
 * We improved the endpoints by using implicit route model binding.
 * This way, Laravel will inject the Article instance in our methods
 * and automatically return a 404 if it isn’t found.
 * Example: api/articles/1
 * Laravel will fetch the article with id 1 automatically
 *
 * If we try to fetch an unknown article, Laravel will throw
 * a NotFoundHttpException. You can change that by adjusting
 * app/Exceptions/Handler.php to return a json response.
 *
 */

// You can also use Route::resource('articles', 'ArticleController');
Route::group(['middleware' => 'auth:api'], function() {

    Route::get('articles', 'ArticleController@index');
    Route::get('articles/{article}', 'ArticleController@show');
    Route::post('articles', 'ArticleController@store');
    Route::put('articles/{article}', 'ArticleController@update');
    Route::delete('articles/{article}', 'ArticleController@delete');

});

Route::post('register', 'Auth\RegisterController@register');

Route::post('login', 'Auth\LoginController@login');

/*
 * To send the token in a request, you can do it by sending an attribute
 * api_token in the payload or as a bearer token in the request headers
 * in the form of
 * Authorization: Bearer Jll7q0BSijLOrzaOSm5Dr5hW9cJRZAJKOzvDlxjKCXepwAeZ7JR6YP5zQqnw.
 */
Route::post('logout', 'Auth\LoginController@logout');

/*
 * Auth::guard('api')->user(); // instance of the logged user
 * Auth::guard('api')->check(); // if a user is authenticated
 * Auth::guard('api')->id(); // the id of the authenticated user
 */
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
