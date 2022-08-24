<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\Setting;
use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request; 
use App\models\product;
use App\models\property;
use App\models\category;
use App\models\brand;

class ImportProducts extends Controller
{
    public function index(Content $content)
    {
        $form = new Form();
        $form->action(url('admin/fetchProducts'));

        $form->file('csv',"products csv")->help("Upload csv file to upload products");
        $form->html("<a href='../product.csv' download target='_blank'> download csv sample</a>");
       // $form->text('title');
        
        //$form->disablePjax();
        
        return $content
            ->title('Import Products')
            ->body($form);
    }

    public function store(Request $request)
    {
        $file = $request->file('csv');

        if (($open = fopen($file,"r")) !== FALSE) {



            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
        
                $users[] = $data;
        
            }
            fclose($open);
        }
       $heads=$users[0];
       unset($users[0]);
       $fields=['title','category_id','brand_id','regular_price','sell_price','sku','stock','description','short_description','series_id','meta_description','discount','slug','featured','bestseller','images','warranty','status'];
       $np=['category_id','brand_id','series_id','images'];
       $valid=false;
       foreach($heads as $head){
         if(in_array(trim($head),$fields)){
            $valid=true;
            if(!$valid){
                echo $head;
                die;
            }
         }
       }
       var_dump($valid);
       if($valid){
           $cind=array_search('category_id',$heads);
            $bind=array_search('brand_id',$heads);
            
            foreach($users as $user){
                
                //category id
                $cquery=category::where(["name"=>trim($user[$cind])]);
                if($cquery->exists()){
                    $cat=$cquery->first();
                    $cid=$cat->id;
                }else{
                    $cat=new category();
                    $cat->name=trim($user[$cind]);
                    $cat->slug=strtolower(str_replace($user[$cind]," ","-"));
                    $cid=$cat->id;
                }
//brand id

            $bquery=brand::where(["name"=>trim($user[$bind])]);
                if($bquery->exists()){
                    $brand=$bquery->first();
                    $bid=$brand->id;
                }else{
                    $brand=new brand();
                    $brand->name=trim($user[$bind]);
                    $brand->slug=strtolower(str_replace($user[$bind]," ","-"));
                    $bid=$brand->id;
                }
                echo $bid;
                echo $cid;
                
                $product=new product();
                $i=0;
                foreach($heads as $head){
                    if(trim($head)!="" && in_array($head,$fields)){
                        if(!in_array(trim($head),$np)){
                            $product->{trim($head)}=trim($user[$i]);
                        }
                    }
                    // else{
                    //     if($head!='category_id' || $head!='brand_id' || $head!='series_id' || $head!='images'){
                    //         $product->{trim($head)}=trim($user[$i]);
                    //     }
                    // }
                    $i++;
                }
                //$product->slug=strtolower($user[0]);
                $product->category_id=$cid;
                $product->brand_id=$bid;
                $product->save();
                $pid=$product->id;
                //product attributes
                $i=0;
                foreach($heads as $head){
                    if(trim($head)!="" && !in_array($head,$fields)){
                        if(!in_array(trim($head),$np)){
                            $pmodel=new property();
                            $pmodel->property_name=trim($head);
                            $pmodel->property_value=trim($user[$i]);
                            $pmodel->product_id=$pid;
                            $pmodel->save();
                        }
                    }
                    $i++;
                }


            }
            
       }


      
       dd($users);
    }
}