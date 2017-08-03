<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

/*
We’ve also added the response()->json() call to our endpoints.
This lets us explicitly return JSON data as well as send an HTTP
code that can be parsed by the client. The most common codes
you’ll be returning will be:

* 200: OK. The standard success code and default option.
* 201: Object created. Useful for the store actions.
* 204: No content. When an action was executed successfully, but there is no content to return.
* 206: Partial content. Useful when you have to return a paginated list of resources.
* 400: Bad request. The standard option for requests that fail to pass validation.
* 401: Unauthorized. The user needs to be authenticated.
* 403: Forbidden. The user is authenticated, but does not have the permissions to perform an action.
* 404: Not found. This will be returned automatically by Laravel when the resource is not found.
* 500: Internal server error. Ideally you're not going to be explicitly returning this, but if
       something unexpected breaks, this is what your user is going to receive.
* 503: Service unavailable. Pretty self explanatory, but also another code that is not going
       to be returned explicitly by the application.
*/


    public function index()
    {
        return Article::all();
    }

    public function show(Article $article)
    {
        return $article;
    }

    public function store(Request $request)
    {
        $article = Article::create($request->all());

        return response()->json($article, 201);
    }

    public function update(Request $request, Article $article)
    {
        $article->update($request->all());

        return response()->json($article, 200);
    }

    public function delete(Article $article)
    {
        $article->delete();

        return response()->json(null, 204);
    }
}
