<?php

namespace App\Admin\Controllers;

use App\Models\blog;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BlogController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Blogs';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new blog());

        // $grid->column('id', __('Id'));
        $grid->column('title', __('Title'))->filter("like");
        // $grid->column('slug', __('Slug'));
        // $grid->column('content', __('Content'));
        $grid->column('category', __('Category'));
        $grid->column('tags', __('Tags'));
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));
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
        $show = new Show(blog::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('slug', __('Slug'));
        $show->field('content', __('Content'))->unescape();
        $show->field('category', __('Category'));
        $show->field('tags', __('Tags'));
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
        $form = new Form(new blog());

        $form->text('title', __('Title'));
        $form->text('slug', __('Slug'));
        $form->ckeditor('content', __('Content'));
        //$form->textarea('content', __('Content'));
        $form->text('category', __('Category'));
        $form->tags('tags', __('Tags'));

        return $form;
    }
}
