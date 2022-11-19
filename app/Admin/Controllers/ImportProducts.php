<?php

namespace App\Admin\Controllers;

use Illuminate\Support\Facades\DB;
use App\Admin\Forms\Setting;
use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request; 
use App\Models\category;
use App\Models\product;
use App\Models\property;
use App\Models\brand;
use App\Models\brandcategory;
use Encore\Admin\Auth\Permission;


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
       $fields=['title','category_id','brand_id','regular_price','sell_price','sku','stock','description','short_description','series_id','meta_description','discount','slug','images','warranty'];
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
                    $cat->save();
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
                    $brand->save();
                    $bid=$brand->id;
                }
                
                
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


      
       
    }

   public function categoryOrder(Content $content){
    Permission::check('usermisc');
         $cat= category::whereNull('parent_id')->pluck('name','id');
         $s=DB::table('category_orders')->first();
         $html="";
         $sct="";
            if($s){
               $sct=json_decode($s->cid,true);
               $gsct=rtrim(implode(",", $sct),","); 
            }
         $form = new Form();
         $form->action(url('admin/savecats'));
         $form->multipleSelect("cats", 'Select Categories')->options($cat)->help("Select category in order you want")->value($sct);

        //$form->html("<a href='../product.csv' download target='_blank'> download csv sample</a>");
       // $form->text('title');
        
        //$form->disablePjax();
        
        return $content
            ->title('Customize Category Order')
            ->body($form);
    }

   public function savecats(Request $request){
    Permission::check("usermisc");
        $cats=isset($request->cats) ? $request->cats:null;
        if($cats){
            if(count($cats)>0){
            $c=count($cats);
            if(!$cats[$c-1]){
               unset($cats[$c-1]);
            }
            DB::table('category_orders')->delete();
            $cids=[];
                
                DB::table('category_orders')->insert(['cid'=>json_encode($cats)]);
            
            
        return redirect()->back();
      }
        } 
    }

    public function getchilds(Request $request){
        Permission::check("usermisc");
      $q=isset($request->q) ? $request->q:null;
      $ct=category::where(['parent_id'=>$q])->selectRaw('id, name as text')->get()->toArray();
      return $ct;    
    }
    
    public function getbrandcategory(Request $request){
        Permission::check("usermisc");
      $q=isset($request->q) ? $request->q:null;
      $ct=brandcategory::where(['brand_id'=>$q])->whereNull('parent_id')->selectRaw('id, name as text')->get()->toArray();
      return $ct;  
    }
    public function getbrandsubcategory(Request $request){
        Permission::check("usermisc");
      $q=isset($request->q) ? $request->q:null;
      $ct=brandcategory::where(['parent_id'=>$q])->whereNotNull('parent_id')->selectRaw('id, name as text')->get()->toArray();
      return $ct;
    }
}