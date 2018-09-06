<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resource('users', 'UsersController');
    $router->resource('categories', 'CategoriesController');
    $router->resource('topics', 'TopicsController', ['only' => ['index', 'destroy', 'show']]);
    $router->resource('replies', 'RepliesController', ['only' => ['index', 'destroy']]);

    $router->resource('series', 'SeriesController');

    $router->resource('videos', 'VideosController');

});
