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


class CartController extends Controller
{
    public function addtoCart(Request $request){
     $pid=isset($request->pid) ? $request->pid :null;
     $qty=isset($request->qty) ? $request->qty : 1;
     $vid=(isset($request->varid) && ($request->varid!="")) ? $request->varid : 0;
     $product=product::find($pid);
      $vp=productVariantOptions::find($vid);

    


     if($product){
        $at=array("image"=>$product->pimage->image ?? '','discount'=>$product->discount);
        if($vp){
           $at=array("image"=>$product->pimage->image ?? '','discount'=>$product->discount,'name'=>$vp->attribute_name,'value'=>$vp->attribute_value,'rprice'=>$vp->regular_price,'sprice'=>$vp->sell_price);
        }
        
        \Cart::add(array(
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->regular_price,
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

}
