<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Table;
use App\Models\product;
use App\Models\brand;
use App\Models\category;
use App\Models\User;
use App\Models\order;
use App\Models\blog;
use App\Models\query;
use Illuminate\Support\Facades\URL;



class HomeController extends Controller
{
    public function index(Content $content){

        
        return $content
        ->title('Dashboard')
        ->description('Description...')
        ->row(Dashboard::title())
            ->row(function (Row $row) {
               
         
                $row->column(4, function (Column $column) {
                    $cp=product::count();
                    $cc=category::count();
                    $cb=brand::count();
                    $purl=url("admin/products");
                    $curl=url("admin/categories");
                    $burl=url("admin/brands");
                    $box1 = new Box('Products', "<a href='".$purl."'>".$cp."&nbsp;<i class='fa fa-external-link pull-right'></i></a>");
                    $box1->style('info');
                    $box1->solid();
                    $box2 = new Box('Categories', "<a href='".$curl."'>".$cc."&nbsp;<i class='fa fa-external-link pull-right'></i></a>");
                    $box2->style('info');
                    $box2->solid();
                    $box3 = new Box('Brands', "<a href='".$burl."'>".$cb."&nbsp;<i class='fa fa-external-link pull-right'></i></a>");
                    $box3->style('info');
                    $box3->solid();
                    $column->append($box1);
                    $column->append($box2);
                    $column->append($box3);
                });

                $row->column(4, function (Column $column) {
                    $cu=User::count();
                    $uurl=url("admin/users");
                    $box1 = new Box('Customers', "<a href='".$uurl."'>".$cu."&nbsp;<i class='fa fa-external-link pull-right'></i></a>");
                    $box1->style('info');
                    $box1->solid();

                    $co=order::count();
                    $ourl=url("admin/orders");
                    $box2 = new Box('Orders',  "<a href='".$ourl."'>".$co."&nbsp;<i class='fa fa-external-link pull-right'></i></a>");
                    $box2->style('info');
                    $box2->solid();
                    $column->append($box1);
                    $column->append($box2);
                });

                $row->column(4, function (Column $column) {
                    $cols=['title','price','brand','category'];
                    $pp=product::orderBy("id")->take(5)->get();
                    $r=[];
                    foreach($pp as $p){
                     $r[]=[$p->title,$p->regular_price,$p->category->name,$p->brand->name];
                    }
                    //$pr=array_column($pp,'title','regular_price','category_id','brand_id');
                    $table = new Table($cols, $r);
                    $box1 = new Box('New Products',  $table);
                    $box1->style('info');
                    $box1->solid();
                    $column->append($box1);
                    
                    $box2 = new Box('New Orders',  $table);
                    $box2->style('info');
                    $box2->solid();
                    $column->append($box2);

                    $box3 = new Box('Recent Quotes',  $table);
                    $box3->style('info');
                    $box3->solid();
                    $column->append($box3);
                });
            });
        
    }
    public function index1(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->description('Description...')
            ->row(Dashboard::title())
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    
                    $column->append(Dashboard::dependencies());
                });
            });
    }
}
