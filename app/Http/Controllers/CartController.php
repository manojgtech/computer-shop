<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use App\Models\brand;
use App\Models\deal;
use App\Models\widget;
use App\Models\common;
use App\Models\address;
use Illuminate\Support\Facades\Auth;
use App\Models\productVariantOptions;
use App\Models\PreownedPC;
use App\Models\Wishlist;


class CartController extends Controller
{
    public function addtoCart(Request $request){
     $pid=isset($request->pid) ? $request->pid :null;
     $qty=isset($request->qty) ? $request->qty : 1;
     $type=isset($request->type) ? $request->type : 'product';
     $vid=(isset($request->varid) && ($request->varid!="")) ? $request->varid : 0;
      if($type=='product'){
        $product=product::find($pid);
        if($vid!=0){
            $vp=productVariantOptions::find($vid);
         }else{
            $vp=null;
         }
      }else{
        $product=PreownedPC::find($pid);
        $vp=null;
      }
     
     
      

    


     if($product){
        $at=array("image"=>$product->pimage->image ?? '','discount'=>$product->discount);
        if($vp){
           $at=array("image"=>$product->pimage->image ?? '','discount'=>$product->discount,'name'=>$vp->attribute_name,'value'=>$vp->attribute_value,'rprice'=>$vp->regular_price,'sprice'=>$vp->sell_price);
        }else{
            $at=[];
        }
         $price=isset($product->regular_price) ? $product->regular_price :$product->sell_price;
        \Cart::add(array(
            'id' => $product->id,
            'name' => $product->title,
            'price' => $price,
            'quantity' => $qty,
             'attributes' => $at,
            'associatedModel' => $product
        ));
     }

     echo \Cart::getTotalQuantity();
     
    }
    public function updatecart(Request $request){
            $pid=isset($request->pid) ? $request->pid :null;
            $qty=isset($request->qty) ? $request->qty : 1;
            $sign=isset($request->sign) ? $request->sign : 1;
            if($qty>0){
           \Cart::update($pid,array(
               'quantity' => $sign==1 ? +1 : -1,
           ));
       }else{

        
       \Cart::remove($pid);  
           
       }
        echo $qty;
       }
       public function deleteCart(Request $request){
        $pid=isset($request->pid) ? $request->pid :null;
       \Cart::remove($pid);   
        echo \Cart::getTotalQuantity();
       }

     public function mycart(Request $request){
        $data=common::commonData('category');
        $data['sections']=widget::all()->pluck("content",'name');
        $data['maincats']=category::where(['parent_id'=>null])->get();
        $data['items'] = \Cart::getContent();
        $data['quantity']=\Cart::getTotalQuantity();
        $data['amount']=\Cart::getTotal();
    return view('cart',$data);
}
     public function checkout(){
        $address=null;
        if(Auth::check()){
            $id=$user=Auth::user()->id;
            $address=address::distinct('id','name','company','street','city','phone')->where('customer_id',$id)->where('type',1)->whereNotNull('phone')->take(5)->groupBy('name')->groupBy('street')->get();

            
        }
        $data['cats']=category::all();
        $data['sections']=widget::all()->pluck("content",'name');
        $data['maincats']=category::where(['parent_id'=>null])->get(); 
        $data['items'] = \Cart::getContent();
		$data['total']=\Cart::getTotal();
		$data['quantity']=\Cart::getTotalQuantity();
        $br=brand::all()->chunk(3);
        $data['brandlinks']=$br;
        $data['address']=$address;
        $data['quantity']=\Cart::getTotalQuantity();
        $data['amount']=\Cart::getTotal();
        return view('checkout',$data);
     }

     function addtowishlist(Request $request){
        $wish=Wishlist::where(['user_id'=>$request->user_id,"product_id"=>$request->pid])->first();
        if(!$wish){
            $wishlist=new Wishlist;
            $userid=$request->user_id;
            $wishlist->user_id=$request->user_id;
            $wishlist->product_id=$request->pid;
            if($wishlist->save()){
                echo 1;
                die;
            }
        }
        
        die;
     }

     public function  wishlist(){
       $userid=Auth::user()->id;
       $wlist=Wishlist::where("user_id",$userid)->get();
       if($wlist){
         $data=common::commonData('brand');
         $data['npcs']=$wlist;
         return view('wishlist',$data);
       }else{
         echo "No item in wishlist";
       }

     }

}
