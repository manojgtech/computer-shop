<?php

namespace App\Admin\Actions\ProductController;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use App\Models\faq;
use App\Models\poroductSeries;
use App\Models\poroductImage;
use App\Models\productVariant;
use App\Models\property;
use App\Models\productVariantOptions;

class Replicate extends RowAction
{
    public $name = 'copy';

    public function handle(Model $model)
    {   
       
          
        $copy=$model->replicate();
        $s=$copy->save();
        if($s){
            $cid=$copy->id;
              $id=$model->id;
              $faqs=faq::where('product_id',$id)->get();
              $productVariantOptions=productVariantOptions::where('product_id',$id)->get();
              $imgs=poroductImage::where('product_id',$id)->get();
              $pros=property::where('product_id',$id)->get();
              if($faqs){
                foreach($faqs as $faq){
                    $cfaq=$faq->replicate();
                    $cfaq->product_id=$cid;
                    $cfaq->save();
                }
              }
              if($productVariantOptions){
                foreach($productVariantOptions as $productVariantOption){
                    $cproductVariantOption=$productVariantOption->replicate();
                    $productVariantOption->product_id=$cid;
                    $productVariantOption->save();
                }
              }
              if($imgs){
                foreach($imgs as $faq){
                    $cfaq=$faq->replicate();
                    $cfaq->product_id=$cid;
                    $cfaq->save();
                }
              }
              if($pros){
                foreach($pros as $faq){
                    $cfaq=$faq->replicate();
                    $cfaq->product_id=$cid;
                    $cfaq->save();
                }
              }

 

        }
return $this->response()->success('Product duplicated successfully.')->refresh();

        
    }

}