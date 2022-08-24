<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('brands', BrandController::class);
    $router->resource('products', ProductController::class);
   // $router->get('products/import', [ProductController::class,]);
    $router->resource('categories', CategoryController::class);
    $router->resource('blogs', BlogController::class);
    $router->resource('users', UserController::class);
    $router->resource('properties', PropertyController::class);
    $router->resource('poroduct-series', SeriesController::class);
    $router->resource('orders', OrderController::class);
    $router->resource('queries', QueryController::class);
    $router->resource('widgets', WidgetController::class); 
    $router->resource('faqs', FaqsController::class);
   // $router->resource('products', ImportProducts::class);
    $router->get("ImportProducts",[App\Admin\Controllers\ImportProducts::class,'index']);
    $router->post("fetchProducts",[App\Admin\Controllers\ImportProducts::class,'store']);
    $router->get("fetchProducts",[App\Admin\Controllers\ImportProducts::class,'index']);
    $router->resource('deals', DealsController::class);
    $router->resource('widgets', WidgetController::class);
    
});
