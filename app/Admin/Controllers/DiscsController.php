<?php

namespace App\Admin\Controllers;

use App\Models\HardDisks;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DiscsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'HardDisks';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    
     protected function grid()
    {
        $grid = new Grid(new HardDisks());
        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('size', __('Size'));
        $grid->column('price', __('Price'));

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
        $show = new Show(HardDisks::findOrFail($id));
        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('size', __('Size'));
        $show->field('price', __('Price'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new HardDisks());
        $form->text('title', __('Title'));
        $form->text('size', __('Size'));
        $form->number('price', __('Price'));

        return $form;
    }
}

