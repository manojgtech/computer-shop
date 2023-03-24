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

        $grid->header(function($query){
            $url=url('admin/rams');
            $url1=url('admin/graphics');
            $url2=url('admin/hard-disks');
            $url3=url('admin/wifis');
            $url4=url('admin/processors');
             return "<a href='".$url4."' class='btn btn-primary btn-lg' target='_blank'>Processors &nbsp;</a> &nbsp;&nbsp;&nbsp;<a href='".$url."' class='btn btn-primary btn-lg' target='_blank'>Ram &nbsp;</a> &nbsp;&nbsp;&nbsp;<a href='".$url1."' class='btn btn-info btn-lg' target='_blank'>Graphic Cards &nbsp;<i class='fa fa-gift'><i></a>&nbsp;&nbsp;&nbsp;<a href='".$url2."' class='btn btn-info btn-lg' target='_blank'>Hard disk &nbsp;<i class='fa fa-category'><i></a>&nbsp;&nbsp;&nbsp;<a href='".$url3."' class='btn btn-info btn-lg' target='_blank'>Wifi &nbsp;<i class='fa fa-category'><i></a>";
         });
        

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
        $form->multipleSelect('processors', __('Processor'))->options($processors);
        $form->multipleSelect('ram', __('Ram'))->options($rams);
        $form->multipleSelect('hdd', __('Hdd'))->options($hdds);
        $form->multipleSelect('graphics', __('Graphics'))->options($graphics);
        $form->multipleSelect('wifi', __('Wifi'))->options($wifis);
        $form->number('warranty', __('Warranty'));
        $form->number('warranty_price', __('Warranty price per year'));
        $form->ckeditor('description', __('Description'));
        $form->file('defaultpic', __('Pic'));
        $form->multipleImage("images", "Product Gallery")->pathColumn('image')->move('public/products/')->removable();
        
        

        return $form;
    }
}
