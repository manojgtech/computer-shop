<?php

namespace App\Admin\Controllers;

use App\Models\order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\User;
use App\Models\product;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'order';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new order());
        $users=User::all()->toArray();
        $userlist=array_column($users,'name','id');
        $prd=product::all()->toArray();
        $plist=array_column($prd,'title','id');
        $grid->column('id', __('Id'));
        $grid->column('customer.name', __('Customer'))->filter($userlist);
        $grid->column('product_id', __('Product id'))->filter($plist);
        $grid->column('quantity', __('Quantity'));
        $grid->column('amount', __('Amount'))->filter('range');
        $grid->column('status', __('Status'))->filter(['4'=>"completed","3"=>"transit"]);
        $grid->column('created_at', __('Created at'))->filter("range","date");
        $grid->column('updated_at', __('Updated at'))->filter("range","date");

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
        $show = new Show(order::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('customer_id', __('Customer id'));
        $show->field('product_id', __('Product id'));
        $show->field('quantity', __('Quantity'));
        $show->field('amount', __('Amount'));
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
        $form = new Form(new order());

        $form->number('customer_id', __('Customer id'));
        $form->number('product_id', __('Product id'));
        $form->number('quantity', __('Quantity'));
        $form->number('amount', __('Amount'));
        $form->switch('status', __('Status'));

        return $form;
    }
}
