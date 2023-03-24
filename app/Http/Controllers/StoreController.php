<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use App\Models\brand;
use App\Models\deal;
use App\Models\widget;
use App\Models\common;
use App\Models\attributes;
use App\Models\faq;
use App\Models\property;
use App\Models\banners;
use App\Models\Wishlist;
use App\Models\productVariantOptions;

class StoreController extends Controller
{
    public function categories(Request $request){
         $data=common::commonData('category');
         $category=$request->category;
         $uris= $request->getRequestUri();
         $uriparts=explode("/",$uris);
         $urin=count($uriparts);
         $data['page']="";
         $data['pcat']="";
         if($urin>1){
            $data['page']=$uriparts[$urin-2];
            $data['pcat']=$uriparts[$urin-1];
         }
         $cat=category::where(['slug'=>$category])->first();
         if($cat){
            $data["category_name"]=$cat->name;
            if($cat->parent_id!==NULL || $cat->parent_id!==0){
                
                $data['products']=product::where(['maincategory_id'=>$cat->id])->get();
            }else{
              
                $data['products']=product::where(['category_id'=>$cat->id])->get();
            }
            
         }else{
            $data["category_name"]="";
            $data['products']=[];
         }
         return view('products',$data);

    }

    public function brands(Request $request){
    $data=common::commonData('brand');
    $q=isset($request->brand) ? $request->brand:null ;
    if($q){
        $b=brand::where(['slug'=>$q])->first();
        $name=$b->name;
      $res=product::where(['brand_id'=>$b->id]);
      $count=$res->count();
      $res1=$res->get();
    }else{
        $name="";
        $res1=[];
        $count=0;
    }

    $data['name']=$name;
    $data['products']=$res1;
    $data['count']=$count;
         return view('brands',$data);
   }

   public function allbrands(Request $request){
    $data=common::commonData('brand');
    $data['allbrands']=brand::all();
    return view('allbrands',$data);
   }
   public function allcategories(Request $request){
    $data=common::commonData('brand');
    $data['allcategories']=category::whereNull('parent_id')->get();
    return view('allcategories',$data);
   }
    

   public function categoryProducts(Request $request){
    $page=isset($request->page) ? (int)$request->page : 1;
    $param= isset($request->cat) ?$request->cat:"";
    $sort= isset($request->sort) ?$request->sort:"l";
    $min= isset($request->min) ? $request->min:100;
    $max= isset($request->max) ? $request->max:100000;
    $c=0;
     $limit=10;
     $off=($page-1)*$limit;

    if($param!=""){
        $cat=category::where(['slug'=>$param])->first();
        
        if($cat){
            $data["category_name"]=$cat->name;

            if($cat->parent_id==NULL || $cat->parent_id==0){
            $query=product::where(['maincategory_id'=>$cat->id]);
        }else{
            $query=product::where(['category_id'=>$cat->id]);
        }
       
        if($min!=$max && $min>0 && $max>0){
            $query->whereBetween("regular_price",[$min,$max]);
         }
      
        switch ($sort) {
            case 'l':
                $query->orderBy("created_at","desc");
                break;
                case 'l':
                    $query->orderBy("created_at","desc");
                    break;
                    case 'o':
                        $query->orderBy("created_at","asc");
                        break;
                        case 'pl':
                            $query->orderBy("regular_price","asc");
                            break;
                            case 'ph':
                                $query->orderBy("regular_price","desc");
                                break;
            
            default:
                 
                $query->orderBy("created_at","desc");
                
                break;
        }
         $c=$query->count();
         $totalpage=ceil($c/$limit);
        $query->skip($off)->take($limit);
        $data['products']=$query->get();
        }else{
           $c=0;
           $totalpage=0;
            $data['products']=[];

        }
    }else{
        $data['products']=product::all()->take(20);
        $c=20;
    }
      
     $html= view("layouts.productsview",$data)->render();
     return response()->json(['view'=>$html,'count'=>$c,'limit'=>$limit,'page'=>$page,'pagen'=>$totalpage]);
   }
   public function singleProduct(Request $request){
    $atts=attributes::all()->pluck('property_name');
    $attributes=$atts->toArray();
    $data=common::commonData('single');
    $data['ad_banners']=banners::where('position','vertical')->first();
    $slug=isset($request->slug) ? $request->slug:null; 
    if($slug){
        $data['product']=product::where(['slug'=>$slug])->first();
        if($data['product']){
            $wish=Wishlist::where(["product_id"=>$data['product']->id])->first();
        $variations=productVariantOptions::where(['product_id'=>$data['product']->id])->whereIn("attribute_name",$attributes)->get()->toArray();
        $data['faqs']=faq::where(['product_id'=>$data['product']->id])->get();
        $vdata=[];
        $i=0;
        $groups=property::select('group_heading')->where("product_id",$data['product']->id)->groupBy('group_heading')->orderBy('id','asc')->get()->toArray();
    
    $atb=[];
    foreach($groups as $group){
        $a=property::where("product_id",$data['product']->id)->where('group_heading',$group['group_heading'])->get()->toArray();
        $atb[$group['group_heading']]=$a;
    }

    $data['props']=$atb;
    
        $pranges=null;
        if($variations){
             $pranges= productVariantOptions::where(['product_id'=>$data['product']->id])->selectRaw(" MIN(regular_price) AS minp, MAX(regular_price) AS maxp")->get();
              foreach($variations as $var){
                $vdata[$var['attribute_name']][]=$var;
                $i++;
            }  
        }else{
          $vdata=null;
        }
    }else{
        echo "no product";
    } 
        
        
    }else{
        echo "no product";
    }
    //dd($vdata);
    if(!$data['product']){
        echo "404";
        die;
    }
    
    $data['cat']="";
    $data['vars']=$vdata;
    $data['pranges']=$pranges;
    $data['relprods']=product::where(['maincategory_id'=>$data['product']->maincategory_id])->orWhere(['category_id'=>$data['product']->category_id])->get();
    
    return view("singleproduct",$data);
   }

   function search(Request $request){
    $data=common::commonData('search');
    $q=$request->q;
    $data['q']=$q;
    $res=product::with(['category'=>function($query) use($q){
      return  $query->orWhere("name","like","%".$q."%");
    },'brand'=>function($query) use($q){
      return  $query->orWhere("name","like","%".$q."%");
    },'variant'=>function($query) use($q){
        return  $query->orWhere("attribute_value","like","%".$q."%");
    }])->orWhere('title','like',"%".$q."%")->get();
    $data['products']=$res;
         return view('productsearch',$data);
   }
}
