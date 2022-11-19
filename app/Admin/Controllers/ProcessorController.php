<?php

namespace App\Admin\Controllers;

use App\Models\Processor;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProcessorController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Processor';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Processor());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('cache', __('Cache'));
        $grid->column('speed', __('Speed'));
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
        $show = new Show(Processor::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('cache', __('Cache'));
        $show->field('speed', __('Speed'));
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
        $form = new Form(new Processor());

        $form->text('name', __('Name'));
        $form->text('cache', __('Cache'));
        $form->text('speed', __('Speed'));
        $form->number('price', __('Price'));

        return $form;
    }
}
