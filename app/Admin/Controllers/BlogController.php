<?php

namespace App\Admin\Controllers;

use App\Models\blog;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use App\Http\Requests;

class BlogController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Blogs';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new blog());

        // $grid->column('id', __('Id'));
        $grid->column('title', __('Title'))->filter("like");
        // $grid->column('slug', __('Slug'));
        // $grid->column('content', __('Content'));
        $grid->column('category', __('Category'));
        $grid->column('tags', __('Tags'));
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
        $show = new Show(blog::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('slug', __('Slug'));
        $show->field('content', __('Content'))->unescape();
        $show->field('category', __('Category'));
        $show->field('tags', __('Tags'));
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
        $form = new Form(new blog());

        $form->text('title', __('Title'));
        $form->text('slug', __('Slug'));
        $form->ckeditor('content', __('Content'));
        //$form->textarea('content', __('Content'));
        $form->text('category', __('Category'));
        $form->tags('tags', __('Tags'));

        return $form;
    }

    public function uploadImage(Request $request){
    
    if($request->hasFile('upload')) {
        //get filename with extension
        $type=isset($request->type) ? $request->type : 'image';
        $filenamewithextension = $request->file('upload')->getClientOriginalName();
   
        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
   
        //get file extension
        $extension = $request->file('upload')->getClientOriginalExtension();
   
        //filename to store
        $filenametostore = $filename.'_'.time().'.'.$extension;
   
        //Upload File
       // $request->file('upload')->storeAs('/', $filenametostore);
       $request->file('upload')->move(public_path('assets'), $filenametostore);
 
        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = asset('assets/'.$filenametostore); 
        $msg = 'Image successfully uploaded'; 
        $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
        if($type!="image"){
          return response()->json([ 'fileName' => $filenametostore, 'uploaded' => 1, 'url' => $url, ]);
      }else{
         //return response()->json(['data'=>$re]);
      
        // Render HTML output 
        @header('Content-type: text/html; charset=utf-8'); 
        echo $re;
    }
    }
  }
}