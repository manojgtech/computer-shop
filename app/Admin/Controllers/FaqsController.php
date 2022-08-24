<?php

namespace App\Admin\Controllers;

use App\Models\faq;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\product;
Use Encore\Admin\Widgets\Table;

class FaqsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Frequently Asked Questions';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new faq());
        $products=product::all()->toArray();
        $cats=array_column($products,'title','id');
        $grid->column('id', __('Id'));
        // $grid->column('id', 'id')->expand(function ($model) {

        //     $comments = $model->comments()->take(10)->get()->map(function ($comment) {
        //         return $comment->only(['id', 'content', 'created_at']);
        //     });
        
        //     return new Table(['ID', 'content', 'release time'], $comments->toArray());
        // });
        $grid->column('product.title', __('Product'))->filter($cats);
        $grid->question()->display(function ($question) {
            return $question;
        });
        $grid->answer()->display(function ($answer) {
            return $answer;
        });
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
        $show = new Show(faq::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('product.title', __('Product'));
        $show->field('question', __('Question'))->unescape();
        $show->field('answer', __('Answer'))->unescape();
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
        $form = new Form(new faq());
        $products=product::all()->toArray();
        $cats=array_column($products,'title','id');
        $form->select('product_id', __('Product'))->options($cats);
        $form->ckeditor('question', __('Question'));
        $form->ckeditor('answer', __('Answer'));
        

        return $form;
    }
}
