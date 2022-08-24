<?php

namespace App\Admin\Controllers;

use App\Models\query;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class QueryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User Query';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new query());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'))->filter('like');
        $grid->column('email', __('Email'))->filter('like');
        $grid->column('phone', __('Phone'))->filter('like');
        $grid->column('message', __('Message'));
        $grid->column('subject', __('Subject'));
        $grid->column('created_at', __('Created at'))->filter('range','date');
        $grid->column('updated_at', __('Updated at'))->filter('range','date');

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
        $show = new Show(query::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('phone', __('Phone'));
        $show->field('message', __('Message'));
        $show->field('subject', __('Subject'));
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
        $form = new Form(new query());

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->mobile('phone', __('Phone'));
        $form->textarea('message', __('Message'));
        $form->text('subject', __('Subject'));

        return $form;
    }
}
