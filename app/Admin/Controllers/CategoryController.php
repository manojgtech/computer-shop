<?php

namespace App\Admin\Controllers;

use App\Models\category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product Category';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new category());

        $categories=category::where(['parent_id'=>null])->get()->toArray();
        $cats=array_column($categories,'name','id');

        $grid->column('id', __('Id'));
        $grid->column('parent.name', __('Parent'))->filter($cats);
        
        $grid->column('name', __('Name'))->filter('like');
        $grid->column('slug', __('Slug'));
        // $grid->column('description', __('Description'));
        

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
        $show = new Show(category::findOrFail($id));


        $show->field('id', __('Id'));
        $show->field('parent.name', __('Parent_id'));
        $show->field('name', __('Name'));
        $show->field('slug', __('Slug'));
        $show->field('description', __('Description'));
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
        $form = new Form(new category());
        $parents=category::where(['parent_id'=>null])->get()->toArray();
        $pcats=array_column($parents,"name","id");
        $form->select('parent_id', __('Parent'))->options($pcats);
        $form->text('name', __('Name'));
        $form->text('slug', __('Slug'));
        $form->text('description', __('Description'));

        return $form;
    }
}
