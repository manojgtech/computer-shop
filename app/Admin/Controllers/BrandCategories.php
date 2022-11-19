<?php

namespace App\Admin\Controllers;

use App\Models\brandcategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\brand;

class BrandCategories extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'brandcategory';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $brands=brand::all()->toArray();
        $brands= array_column($brands, 'name','id');
        $grid = new Grid(new brandcategory());
        $grid->model()->whereNull('parent_id');
        $grid->column("name")->filter('like');
        $grid->column('slug','Slug');
        $grid->column('brand.name','Brand')->filter($brands);


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
        $show = new Show(brandcategory::findOrFail($id));
        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('brand.name', __('Brand'));
        $show->field('slug', __('Slug'));
        $show->field('parent_id', __('Main Category'));
        $show->children('children', function ($children) {
            
            $children->setResource('/admin/brandcategories');
            $children->id();
            $children->name();
            $children->slug();

            
            
        });


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {   
        $brands=brand::all()->pluck('name','id');
        $form = new Form(new brandcategory());
       $form->tab('Basic info', function ($form) use($brands) {
        $form->select("brand_id",'Brand')->options($brands);
        $form->text("name",'Name');
        $form->text("slug",'Slug'); 
    })->tab('subcategories', function ($form) use($brands) {
        $form->hasMany('children',"Add subcategories", function (Form\NestedForm $form) use($brands) {
            $form->select("brand_id",'Brand')->options($brands);
                $form->text('name',"Category Name");
                $form->text('slug',"Slug");
            });
       }); 


        return $form;
    }
}
