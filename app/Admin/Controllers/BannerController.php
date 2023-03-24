<?php

namespace App\Admin\Controllers;

use App\Models\banners;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BannerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Banners';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new banners());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('position', __('Position'));
        $grid->column('content', __('Content'));
        $grid->column('image', __('image'))->image();
       
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
        $show = new Show(banners::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('content', __('Content'));
         $show->field('image', __('image'))->image();
         $show->field('position', __('position'))->image();
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
        $form = new Form(new banners());

        $form->text('name', __('Unique Widget Name'));
        $form->select('position', __('Banner Positions'))->options(['horizonal'=>'horizontal','vertical'=>'vertical','2images'=>'2 images','3images'=>'3 images','home_slider'=>'home_slider']);
        $form->textarea('content', __('Content'));
        $form->image('image', __('Image'))->uniqueName()->move('public/brands/public/brands/widgets/')->removable();

        return $form;
    }
}
