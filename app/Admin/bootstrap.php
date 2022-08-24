<?php
Use Encore\Admin\Admin;
use App\Admin\Extensions\Form\Productproperties;
use Encore\Admin\Form;
use App\Admin\Extensions\Form\CKEditor;
/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

Encore\Admin\Form::forget(['map', 'editor']);
Form::extend('productproperty', Productproperties::class);
Form::extend('ckeditor', CKEditor::class);
Form::extend('php', PHPEditor::class);
Admin::css('css/admincustom.css');
Admin::js('js/admincustom.js');

