<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$app->get('/', function() use ($app) {
  return "Hello world :D";
});
// Authorization 
$app->post('oauth/access-token', function() use($app) {
    return response()->json($app->make('oauth2-server.authorizer')->issueAccessToken());
});
// Resource 
$app->group(['prefix' => 'api/v1','namespace' => 'App\Http\Controllers', 'middleware' => 'oauth'], function($app)
{
    $app->get('book','BookController@index');
  
    $app->get('book/{id}','BookController@getbook');
      
    $app->post('book','BookController@createBook');
      
    $app->put('book/{id}','BookController@updateBook');
      
    $app->delete('book/{id}','BookController@deleteBook');
});