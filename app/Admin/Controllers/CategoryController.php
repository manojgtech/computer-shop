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
        echo "<style> .column-logo img{ width:50px;} .column-catimage img{ width:50px;}</style>";
        $grid = new Grid(new category());
         $grid->model()->whereNull('parent_id');
        $categories=category::where(['parent_id'=>null])->get()->toArray();
        $cats=array_column($categories,'name','id');

        $grid->column('id', __('Id'));
        //$grid->column('parent.name', __('Parent'))->filter($cats);
        
        $grid->column('name', __('Name'))->filter('like');
        $grid->column('order_number', __('Order'));
        $grid->column('slug', __('Slug'));
        $grid->column('logo', __('Logo'))->image();
        $grid->column('catimage', __('Image'))->image();

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
        $show->field('order_number', __('Category Order'));
        $show->field('description', __('Description'));
        $show->field('logo', __('Logo'))->image();
        $show->field('banner', __('Banner'))->image();
        $show->children('children', function ($children) {
           // print_r($property);
            $children->setResource(url('/admin/categories'));
        
            $children->name();
            $children->slug();
            
        });
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
        $id= isset($form->model()->id) ? $form->model()->id : null;
        
        $pt=true;
        if($id){
            $ct=category::find($id);
            $pt=$ct->parent_id;
            dd($pt);
            $pt=$ct->parent_id ? false:true;

        }
           
        $form->tab('Main Category', function ($form) use($pt) {
        $parents=category::where(['parent_id'=>null])->get()->toArray();
        $pcats=array_column($parents,"name","id");
        $form->select('parent_id', __('Parent'))->options($pcats);
        $form->text('name', __('Name'));
        $form->text('slug', __('Slug'));
        if($pt){
        $form->number('order_number', __('category order'));
        $form->image('logo', __('Logo'))->uniqueName()->move('public/brands/cats/')->removable();
        $form->image('banner', __('Banner'))->uniqueName()->move('public/brands/cats/')->removable();
        $form->image('catimage', __('Category Image'))->uniqueName()->move('public/catimg')->removable();
        $form->text('description', __('Description'));
    }
         })->tab('child Categories', function ($form) use($pt) {
            if($pt){
          $form->hasMany('children',"Add children", function (Form\NestedForm $form) {
                $form->text('name',"Category Name");
                $form->text('slug',"Slug");

               
            });
      }
         });
        return $form;
    }
}
