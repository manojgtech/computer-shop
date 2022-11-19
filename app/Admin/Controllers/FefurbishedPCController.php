<?php

namespace App\Admin\Controllers;

use App\Models\PreownedPC;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Processor;
use App\Models\Ram;
use App\Models\Graphics;
use App\Models\HardDisks;
use App\Models\wifi;

class FefurbishedPCController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'PreownedPC';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PreownedPC());

        $grid->column('id', __('Id'));
        $grid->column('stock', __('Stock'));
        $grid->column('title', __('Title'));
        
        $grid->column('price', __('Price'));
        $grid->column('sell_price', __('Sell price'));
        $grid->column('ram', __('Ram'));
        $grid->column('hdd', __('Hdd'));
        $grid->column('graphics', __('Graphics'));
        $grid->column('wifi', __('Wifi'));
        $grid->column('warranty', __('Warranty'));
        $grid->column('description', __('Description'));
        $grid->column('status', __('Status'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('slug', __('Slug'));

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
        $show = new Show(PreownedPC::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('stock', __('Stock'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('price', __('Price'));
        $show->field('sell_price', __('Sell price'));
        $show->field('ram', __('Ram'));
        $show->field('hdd', __('Hdd'));
        $show->field('graphics', __('Graphics'));
        $show->field('wifi', __('Wifi'));
        $show->field('warranty', __('Warranty'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('slug', __('Slug'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $processors=Processor::all()->pluck('name','id');
        $rams=Ram::all()->pluck('title','id');
        $graphics=Graphics::all()->pluck('title','id');
        $hdds=HardDisks::all()->pluck('title','id');
        $wifis=wifi::all()->pluck('title','id');
        $form = new Form(new PreownedPC());

        
        $form->text('title', __('Title'));
        $form->text('slug', __('Slug'));
        $form->number('stock', __('Stock'))->default(1);
        $form->number('price', __('Regular Price'));
        $form->number('sell_price', __('Sell price'));
        $form->select('processors', __('Processor'))->options($processors);
        $form->select('ram', __('Ram'))->options($rams);
        $form->select('hdd', __('Hdd'))->options($hdds);
        $form->select('graphics', __('Graphics'))->options($graphics);
        $form->select('wifi', __('Wifi'))->options($wifis);
        $form->number('warranty', __('Warranty'));
        $form->number('warranty_price', __('Warranty price per year'));
        $form->ckeditor('description', __('Description'));
        $form->file('defaultpic', __('Pic'));
        $form->multipleImage("images", "Product Gallery")->pathColumn('image')->move('public/products/')->removable();
        
        

        return $form;
    }
}
