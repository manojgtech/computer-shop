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
    $router->resource('banners', BannerController::class);
    $router->resource('queries', QueryController::class);
    $router->resource('brandcategories', BrandCategories::class);
    $router->resource('widgets', WidgetController::class); 
    $router->resource('faqs', FaqsController::class);
   // $router->resource('products', ImportProducts::class);
    $router->get("ImportProducts",[App\Admin\Controllers\ImportProducts::class,'index']);
    $router->post("fetchProducts",[App\Admin\Controllers\ImportProducts::class,'store']);
    $router->get("fetchProducts",[App\Admin\Controllers\ImportProducts::class,'index']);
    
    $router->get("getchildcategory",[App\Admin\Controllers\ImportProducts::class,'getchilds']);
    $router->get("getbrandcategory",[App\Admin\Controllers\ImportProducts::class,'getbrandcategory']);
    $router->get("getbrandsubcategory",[App\Admin\Controllers\ImportProducts::class,'getbrandsubcategory']);
    $router->get("categoryOrder",[App\Admin\Controllers\ImportProducts::class,'categoryOrder']);
    $router->post("savecats",[App\Admin\Controllers\ImportProducts::class,'savecats']);
    $router->post("uploadImage",[App\Admin\Controllers\BlogController::class,'uploadImage'])->name("uploadImage");
    $router->resource('deals', DealsController::class);
    $router->resource('widgets', WidgetController::class);
    $router->resource('pages', Pagescontroller::class);
    $router->resource('processors', ProcessorController::class);
    $router->resource('rams', RamController::class);
    $router->resource('graphics', GraphicsController::class);
    $router->resource('hard-disks', DiscsController::class);
    $router->resource('preownedpcs', FefurbishedPCController::class);
    $router->resource('wifis', WifiController::class);
    
});

Route::group([
    'middleware' => 'admin.permission:allow,administrator,editor',
], function ($router) {

    $router->get("getchildcategory",[App\Admin\Controllers\ImportProducts::class,'getchilds']);
    $router->get("getbrandcategory",[App\Admin\Controllers\ImportProducts::class,'getbrandcategory']);
    $router->get("getbrandsubcategory",[App\Admin\Controllers\ImportProducts::class,'getbrandsubcategory']);

});
\Illuminate\Support\Facades\URL::forceScheme('https');