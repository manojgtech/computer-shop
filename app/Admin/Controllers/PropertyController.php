<?php

namespace App\Admin\Controllers;

use App\Models\property;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\product;


class PropertyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product Attributes';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new property());
        $srs=product::all()->toArray();
        $psrs=array_column($srs,'title','id');
        // $grid->column('id', __('Id'));
        $grid->column('property_name', __('Property name'))->filter('like');
        $grid->column('property_value', __('Property value'));
        $grid->column('product.title', __('Product'))->filter($psrs);
        

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
        $show = new Show(property::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('property_name', __('Property name'));
        $show->field('property_value', __('Property value'));
        $show->field('product.title', __('Product id'));
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
        $form = new Form(new property());
        $product=product::all()->toArray();
        $list=array_column($product,'title','id');
        $form->text('property_name', __('Property name'));
        $form->text('property_value', __('Property value'));
        $form->select('product_id', __('Product'))->options($list);

        return $form;
    }
}
