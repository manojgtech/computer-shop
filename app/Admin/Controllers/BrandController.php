<?php

namespace App\Admin\Controllers;

use App\Models\brand;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use App\Models\brandcategory;

class BrandController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'brand';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        echo "<style> .column-logo img{ width:50px;}</style>";
        $grid = new Grid(new Brand());
        $grid->filter(function($filter){

            // Remove the default id filter
            $filter->disableIdFilter();
        
            // Add a column filter
            $filter->like('name', 'name');
            $filter->like('slug', 'slug');
        
        });
        
        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'))->filter("like");
        $grid->column('slug', __('Slug'));
        $grid->column('logo', __('Logo'))->image();
        

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
        $show = new Show(Brand::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('slug', __('Slug'));
        $show->brandcategories('brandcategories', function ($brandcategories) {
            
            $brandcategories->setResource('/admin/brandcategories');
            $brandcategories->name();
            $brandcategories->slug();

            
            
        });
        $show->field('logo', __('Logo'))->image();
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
        $form = new Form(new Brand());
         $form->tab('Basic info', function ($form) {
        $form->text('name', __('Name'));
        
        $form->text('slug', __('Slug'));
        $form->image('logo', __('Logo'))->uniqueName()->move('public/brands/')->removable();
        
        })->tab('Category', function ($form) {
            $form->hasMany('brandcategories',"Add categories", function (Form\NestedForm $form) {
                $form->text('name',"Category Name");
                $form->text('slug',"Slug");
            });

         });  
        return $form;
    }
}
