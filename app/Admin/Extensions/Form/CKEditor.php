<?php
namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class CKEditor extends Field
{
    public static $js = [
        'https://cdn.ckeditor.com/4.14.1/full-all/ckeditor.js',
        
    ];

    protected $view = 'admin.ckeditor';

    public function render()
    {
       // $this->script = "$('textarea.{$this->getElementClassString()}').ckeditor();";
        $this->script = "$(window).on('load', function (){ $('.producteditor').each(function () {
        let id = $(this).attr('id');
        console.log(id);
        CKEDITOR.replace( document.querySelector( '#'+id ),{
            filebrowserImageUploadUrl:'".url('admin/uploadImage?_token=')."'+$('meta[name=csrf-token]').attr('content')+'&CKEditorFuncNum=1&command=QuickUpload&type=image&responseType=json',
            filebrowserImageBrowseUrl:'".url('admin/uploadImage?_token=')."'+$('meta[name=csrf-token]').attr('content')+'&CKEditorFuncNum=1',
            filebrowserUploadMethod:'form',
            allowedContent:true,
            extraPlugins: 'uploadimage',
            imageUploadUrl:'".url('admin/uploadImage?_token=')."'+$('meta[name=csrf-token]').attr('content')+'&CKEditorFuncNum=1&command=QuickUpload&type=Files&responseType=json',
            alignment: {
            options: [ 'left', 'right' ]
        },
        
            
        } );
    }); });";
 

        return parent::render();
    }
}