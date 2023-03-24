<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product;
use App\Models\category;
use App\Models\brand;
use App\Models\deal;
use App\Models\widget;
use App\Models\banners;
use Illuminate\Support\Facades\DB;

class common extends Model
{
   
   public function commonData($page=''){
        $data['cats']=category::all();
        $data['sections']=widget::all()->pluck("content",'name');
        if($page=='home'){
        $data['home_banners']=banners::where(['position'=>'home_slider'])->get();
        $data['cat_banner']=banners::where(['position'=>'3images'])->get();
        $data['brand_banner']=banners::inRandomOrder()->where(['position'=>'horizontal'])->first();
        $data['product_banner']=banners::where(['position'=>'2images'])->get();
        }
        if($page=='brand'){
          $data['brand_banner1']=banners::where(['position'=>'horizontal'])->get();
          $data['brand_banner2']=banners::where(['position'=>'vertical'])->get();
        }
         $mcats=category::where(['parent_id'=>null])->get();
        $data['quantity']=\Cart::getTotalQuantity();
         $cats=DB::table('category_orders')->first();
         if($cats){
            $fcat=json_decode($cats->cid,true);
            if(count($fcat)==0){
               $data['maincats']=$mcats;
            }else{
                $cats=category::whereIn("id",$fcat)->get();
                $data['maincats']=$cats;
            }
            
         }else{
           
         }
        $br=brand::inRandomOrder()->take(12)->get()->chunk(3);
        $data['brandlinks']=$br;

        return $data;

   }
}
