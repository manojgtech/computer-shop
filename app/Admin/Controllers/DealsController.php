<?php

namespace App\Admin\Controllers;

use App\Models\deal;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\product;

class Dealscontroller extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product Deals';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new deal());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('image', __('Image'));
        $grid->column('products', __('Product id'))->display(function($products){
            $product=product::whereIn("id",$products)->get()->pluck('title')->toArray();
        
            if(count($product)>0){
                 return implode(",",$product);
            }
            return "NA";
        });
        $grid->column('type', __('Type'))->display(function($type){
            return $type==1 ? 'Hot Deal':'Special Offer';
        });
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(deal::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('image', __('Image'));
        $show->products()->as(function($products){
            $product=product::whereIn("id",$products)->get()->pluck('title')->toArray();
        
        if(count($product)>0){
             return implode(",",$product);
        }
        return "NA";
        });
        $show->field('type', __('Type'))->as(function($type){
            return $type==1 ? 'Hot Deal':'Special Offer';
        });
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
        $products=product::all()->toArray();
        $cats=array_column($products,'title','id');
        $types=['1'=>'Hot Deals','2'=>'Inner Deals','3'=>'Special Offer'];
        $form = new Form(new deal());

        $form->text('name', __('Name'));
        $form->number('discount',__('Deal Discount %'));
        $form->image('image', __('Image'))->rules('mimes:png,jpg,jpeg,gif');
        $form->multipleSelect('products', __('Products'))->options(product::all()->pluck( 'title','id'));
        $form->select('type', __('Type'))->options($types)->default('1');

        return $form;
    }
}
