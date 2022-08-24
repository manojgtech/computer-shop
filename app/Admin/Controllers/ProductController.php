<?php

namespace App\Admin\Controllers;

use App\Models\product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\category;
use App\Models\brand;
use App\Models\poroductSeries;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Collapse;
use Encore\Admin\Layout\Content;


class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Products';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

         
        $grid = new Grid(new product());
         $grid->header(function($query){
            $url=url('admin/ImportProducts');
            $url1=url('admin/deals');
             return "<a href='".$url."' class='btn btn-primary btn-lg' target='_blank'>Upload CSV & Import CSV  &nbsp;<i class='fa fa-upload'><i></a> &nbsp;&nbsp;&nbsp;<a href='".$url1."' class='btn btn-info btn-lg' target='_blank'>Product Deals &nbsp;<i class='fa fa-gift'><i></a>";
         });
        
            $categories=category::all()->toArray();
            $cats=array_column($categories,'name','id');
            $brands=brand::all()->toArray();
            $brands=array_column($brands,'name','id');
            $srs=poroductSeries::all()->toArray();
            $psrs=array_column($srs,'name','id');


        // $grid->column('id', __('Id'));
        $grid->column('title', __('Title'))->filter("like");
        // $grid->column('slug', __('Slug'));
        $grid->column('sku', __('Sku'));
        $grid->column('category.name', __('Category'))->filter($cats);
        $grid->column('brand.name', __('Brand'))->filter($brands);
        $grid->column('series.name', __('Series'))->filter($srs);
        $grid->column('regular_price', __('Price'))->filter('range');
        $grid->column('discount', __('Discount'));
        $grid->column('stock', __('Stock'));
        // $grid->column('sell_price', __('Sell price'));
        // $grid->column('description', __('Description'));
        // $grid->column('short_description', __('Short description'));
        // $grid->column('meta_description', __('Meta description'));
        $grid->column('warranty', __('Warranty'));
        $states = [
            'on' => ['value' => '1', 'text' => 'open', 'color' => 'primary'],
            'off' => ['value' => '0', 'text' => 'close', 'color' => 'default'],
        ];
        $grid->column('status', __('Status'))->switch($states);
        $states = [
            'on' => ['value' => '1', 'text' => 'open', 'color' => 'primary'],
            'off' => ['value' => '0', 'text' => 'close', 'color' => 'default'],
        ];
        $grid->column('featured', __('Featured'))->switch($states);
        $grid->column('bestseller', __('Bestseller'))->switch($states);
        // $grid->column('id')->totalRow(function ($amount) {

        //     return "<span class='text-danger text-bold'><i class='fa fa-yen'></i> {$amount} </span>";
        
        // });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(product::findOrFail($id));
        $categories=category::all()->toArray();
        $cats=array_column($categories,'id','name');
        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('featured', __('Featured'))->as(function ($featured) {
            return $featured==1 ? 'Yes':'No';
        });
        $show->field('bestseller', __('Bestseller'))->as(function ($bestseller) {
            return $bestseller==1 ? 'Yes':'No';
        });
        $show->field('slug', __('Slug'));
        $show->field('sku', __('Sku'));
        $show->field('category.name', __('Category'));
        $show->field('brand.name', __('Brand id'));
        $show->field('series.name', __('Product Series'));
        $show->field('regular_price', __('Regular price(INR)'));
        $show->field('discount', __('Discount(%)'));
        $show->field('stock', __('Stock'));
        $show->field('sell_price', __('Sell price(INR)'));
        $show->description()->unescape();
        $show->field('short_description', __('Short description'))->unescape();
        $show->field('meta_description', __('Meta description'));
        $show->divider("Product Gallery");
        $show->images('gallery', function ($product) {

            $product->setResource('/admin/products');
        
            $product->image()->image();
            
        });
        $show->property('property', function ($property) {
           // print_r($property);
            $property->setResource('/admin/products');
        
            $property->property_name();
            $property->property_value();
            
        });
        $show->divider("Product Attributes");
       // $show->field("property.property_name");
        $show->field('warranty', __('Warranty'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        
        $form = new Form(new product());
       
        $form->tab('Basic info', function ($form) {
        $categories=category::all()->toArray();
        $cats=array_column($categories,'name','id');
        $brands=brand::all()->toArray();
        $brands=array_column($brands,'name','id');
        $srs=poroductSeries::all()->toArray();
        $psrs=array_column($srs,'name','id');
        $form->text('title', __('Title'));
        $form->text('slug', __('Slug'));
        $form->text('sku', __('Sku'));
        $form->select('category_id', __('Product Category'))->options($cats);
        $form->select('brand_id', __('Product Brand'))->options($brands);
        $form->select('series_id', __('Product Series'))->options($psrs);
        $form->radio('featured', __('Featured Product'))->options(['1'=>'Yes','0'=>'No'])->default('0');
        $form->radio('bestseller', __('Bestseller Product'))->options(['1'=>'Yes','0'=>'No'])->default('0');
        $form->number('regular_price', __('Regular price'));
        $form->number('discount', __('Discount'));
        $form->number('stock', __('Stock'));
        $form->number('sell_price', __('Sell price'));
        $form->ckeditor('description', __('Description'));
        $form->ckeditor('short_description', __('Short description'));
        $form->textarea('meta_description', __('Meta description'));
        $form->text('warranty', __('Warranty'));
        $form->select('status', __('Status'))->options(["1"=>"Enabled","0"=>'Draft']);
       
        
        })->tab('Product Images', function ($form) {
            $imf=$form->multipleImage("images", "Product Gallery")->pathColumn('image')->move('public/products/');
        
        })->tab('Product Attributes', function ($form) {
            $form->hasMany('property',"Add Product Attributes", function (Form\NestedForm $form) {
                $form->text('property_name',"Product Attribute Name");
                $form->text('property_value',"Product Attribute Value");
               
            });
        
        });  
         
       
        
        return $form;
    }
    
}
