<?php

namespace App\Admin\Controllers;

use App\Models\product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\category;
use App\Models\attributes;
use App\Models\brand;
use App\Models\faq;
use App\Models\poroductSeries;
use App\Models\productVariant;
use App\Models\productVariantOptions;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Collapse;
use Encore\Admin\Layout\Content;
use App\Models\brandcategory;
use App\Admin\Actions\ProductController\Replicate;


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
            $url2=url('admin/categoryOrder');
        
             return "<a href='".$url."' class='btn btn-primary btn-lg' target='_blank'>Upload CSV & Import CSV  &nbsp;<i class='fa fa-upload'><i></a> &nbsp;&nbsp;&nbsp;<a href='".$url1."' class='btn btn-info btn-lg' target='_blank'>Product Deals &nbsp;<i class='fa fa-gift'><i></a>&nbsp;&nbsp;&nbsp;<a href='".$url2."' class='btn btn-info btn-lg' target='_blank'>Category Order &nbsp;<i class='fa fa-category'><i></a>";
         });
        
   
            $categories=category::whereNull('parent_id')->get()->toArray();
            $cats=array_column($categories,'name','id');
            $categories1=category::whereNotNull('parent_id')->get()->toArray();
            $cats1=array_column($categories1,'name','id');

            $brands=brand::all()->toArray();
            $brands=array_column($brands,'name','id');
            $brandcats=brandcategory::whereNull('parent_id')->get()->toArray();
            $brandcats=array_column($brandcats,'name','id');
            $brandcats1=brandcategory::whereNotNull('parent_id')->get()->toArray();
            $brandcats1=array_column($brandcats1,'name','id');
            $srs=poroductSeries::all()->toArray();
            $psrs=array_column($srs,'name','id');

 $grid->filter(function($filter) use($cats,$cats1,$brands){

    // Remove the default id filter
    $filter->disableIdFilter();

    // Add a column filter
    $filter->like('title', 'name');
     $filter->equal('category_id')->select($cats);
     $filter->like('subcategory_id')->select($cats1);
     $filter->where(function ($query) {

        $query->where('name', 'like', "%{$this->input}%")
            ->orWhere('id', 'like', "%{$this->input}%");
    
    }, 'Text');

});

        // $grid->column('id', __('Id'));
        $grid->column('title', __('Title'))->filter("like");
        // $grid->column('slug', __('Slug'));
        $grid->column('sku', __('Sku'));
        $grid->maincategory_id('Parent Category')->display(function($maincategory_id) {
            $c=Category::find($maincategory_id);
            if($c){
                return $c->name;
            }
            return "";
        })->filter($cats);
        $grid->category_id('Subcategory')->display(function($category_id) {
         $c=Category::find($category_id);
         return isset($c->name) ? $c->name:'';
        })->filter($cats1);
      
        $grid->brand_id('Brand')->display(function($brand_id) {
            $c=Brand::find($brand_id);
            return isset($c->name) ? $c->name:'';
   })->filter($brands);
          $grid->column('brandcategory_id', __('Brand cat'))->display(function($category_id) {
            $b=brandcategory::find($category_id);
            if($b){
                return $b->name;
            }
    return "";
})->filter($brandcats); 

          $grid->column('brand_subcategory', __('Brand sub cat'))->display(function($category_id) {
            $b=brandcategory::find($category_id);
            if($b){
                return $b->name;
            }
    return "";
})->filter($brandcats1); 
    //    $grid->column('series.name', __('Series'))->filter($srs);
        $grid->column('regular_price', __('Price'))->filter('range');
        //$grid->column('discount', __('Discount'));
        $grid->column('stock', __('Stock'));
        
        //$grid->column('warranty', __('Warranty'));
        $states = [
            'on' => ['value' => '1', 'text' => 'open', 'color' => 'primary'],
            'off' => ['value' => '0', 'text' => 'close', 'color' => 'default'],
        ];
        //$grid->column('status', __('Status'))->switch($states);
        $states = [
            'on' => ['value' => '1', 'text' => 'open', 'color' => 'primary'],
            'off' => ['value' => '0', 'text' => 'close', 'color' => 'default'],
        ];
        $grid->column('featured', __('Featured'))->switch($states);
        $grid->column('bestseller', __('Bestseller'))->switch($states);
        // $grid->column('id')->totalRow(function ($amount) {

        //     return "<span class='text-danger text-bold'><i class='fa fa-yen'></i> {$amount} </span>";
        
        // });

     
$grid->actions(function ($actions) {
    $actions->add(new Replicate);
});
      
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
        $show->variant('variant', function ($variant) {
            
            $variant->setResource('/admin/variants');
            $variant->attribute_name();
            $variant->attribute_value();
            $variant->sku();
            $variant->regular_price();
            $variant->sell_price();
            $variant->stock();
            
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
        
        $uris=$_SERVER['REQUEST_URI']; 
        $uris=explode("/",$uris);
        $ul=count($uris);
        $action=$uris[$ul-1];
        $pmodel=null;
        if($action=="edit"){
            $prid=$uris[$ul-2];
            $pmodel=product::find($prid);
             
        }
        
        
        $form->tab('Basic info', function ($form) use($pmodel) {
         if($pmodel){
            $subcategories=category::whereNotNull('parent_id')->where(['id'=>$pmodel->category_id])->get()->toArray();
            $bcats=brandcategory::whereNull('parent_id')->where(['id'=>$pmodel->brandcategory_id])->pluck('name','id');
            $bcats=brandcategory::whereNull('parent_id')->pluck('name','id');
            $bcats1=brandcategory::whereNotNull('parent_id')->where(['id'=>$pmodel->brand_subcategory])->pluck('name','id');
         }else{
            $subcategories=category::whereNotNull('parent_id')->get()->toArray();
            $bcats=brandcategory::whereNull('parent_id')->pluck('name','id');
            $bcats1=brandcategory::whereNotNull('parent_id')->pluck('name','id');
         }   


        
        $categories=category::whereNull('parent_id')->get()->toArray();
        //$subcategories=category::whereNotNull('parent_id')->get()->toArray();
        $cats=array_column($categories,'name','id');
        $subcats=array_column($subcategories,'name','id');
        $brands=brand::all()->toArray();
        $brands=array_column($brands,'name','id');
        //$bcats=brandcategory::whereNull('parent_id')->pluck('name','id');
        //$bcats1=brandcategory::whereNotNull('parent_id')->pluck('name','id');
        $srs=poroductSeries::all()->toArray();
        $psrs=array_column($srs,'name','id');
        $form->text('title', __('Title'));
        $form->text('slug', __('Slug'));
        $form->text('sku', __('Sku'));
        $form->select('maincategory_id', __('Parent Category'))->options($cats)->load('category_id', url('admin/getchildcategory'));
         $form->select('category_id', __('Product Category'))->options($subcats);
        
        $form->select('brand_id', __('Product Brand'))->options($brands)->load('brandcategory_id', url('admin/getbrandcategory'));

        $form->select('brandcategory_id', __('Brand Category'))->options($bcats)->load('brand_subcategory', url('admin/getbrandsubcategory'));
        $form->select('brand_subcategory', __('Brand Sub Category'))->options($bcats1);
        $form->tags('tags', __('tags'));
        $form->select('series_id', __('Product Series'))->options($psrs);
        $form->radio('featured', __('Featured Product'))->options(['1'=>'Yes','0'=>'No'])->default('0');
        $form->radio('bestseller', __('Bestseller Product'))->options(['1'=>'Yes','0'=>'No'])->default('0');
        $form->number('regular_price', __('Regular price'));
       // $form->number('discount', __('Discount'));
        $form->number('stock', __('Stock'));
        $form->number('sell_price', __('Sell price'));
        $form->ckeditor('description', __('Description'));
        $form->ckeditor('short_description', __('Short description'));
        $form->ckeditor('meta_description', __('Meta description'));
        $form->file('pdf', __('Product Pdf '))->removable();
        $form->text('warranty', __('Warranty'));
        $form->select('status', __('Status'))->options(["1"=>"Enabled","0"=>'Draft']);
       
        
        })->tab('Product Images', function ($form) {
            $form->image('defaultpic', __('Default Pic'))->uniqueName()->move('public/products/')->removable();
            $imf=$form->multipleImage("images", "Product Gallery")->pathColumn('image')->move('public/products/')->removable();
        
        })->tab('Product Attributes', function ($form) {
            $form->hasMany('property',"Add Product Attributes", function (Form\NestedForm $form) {
                $form->text('group_heading',"Attribute Group")->default('General');
                $form->text('property_name',"Product Attribute Name");
                $form->ckeditor('property_value',"Product Attribute Value");
            });
               
            })->tab('Product Variants', function ($form) {
                 $atts=attributes::all()->pluck("property_name",'property_name');
                $form->hasMany('variant',"Add Product Variant", function (Form\NestedForm $form) use($atts){
                
                $form->select('attribute_name',"Variation Attribute Name")->options($atts);
                $form->text('attribute_value',"Variation Attribute Values")->help("example(Values):4Gb Ram I3 Processer,4g Gb ,Red");
                
                $form->text('sku',"Variant sku");
                $form->number('regular_price',"Regular Price");
                $form->text('sell_price',"Sell Price");
                $form->number('stock',"Stock");
                $form->image('defaultpic', __('Default Pic'))->uniqueName()->move('public/products/')->removable();
                 

               
            });
        
        })->tab('faq', function ($form) {
                
                $form->hasMany('faq',"Add Product Variant", function (Form\NestedForm $form){
                $form->textarea('question', __('Question'));
                $form->textarea('answer', __('Answer'));
                 

               
            });
        
        });
         
       
        
        return $form;
    }
    
}
