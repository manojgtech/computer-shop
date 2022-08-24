<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class Productproperties extends Field
{
    

    protected $view = 'admin.productproperty-editor';

    public function render()
    {
        
        return parent::render();
    }
}