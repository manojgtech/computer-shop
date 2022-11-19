<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Razorpay\Api\Api;
use App\Models\Payment;
use App\Models\product;
use App\Models\category;
use App\Models\brand;
use App\Models\deal;
use App\Models\widget;
use App\Models\order;
use App\Models\User;
use App\Models\address;
use App\Models\orderItem;
use App\Http\Traits\MailTrait;
use App\Models\common;
use Illuminate\Support\Facades\Auth;
use DB;

 
 class RazorpayPaymentController extends Controller
 {
     public function razorpayProduct()
      {
       return view('razorpay');
      }
 
       public function razorPaySuccess(Request $request){
         $payid=isset($request->razorpay_payment_id) ? $request->razorpay_payment_id : null;
         $sign=isset($request->razorpay_signature) ?  $request->razorpay_signature: null;    
         $amount=$request->amount;
        $orderId=$request->orderid;
          if($payid && $sign){
          	$pay=new Payment;
          	$pay->payment_id=$payid;
          	$pay->signature_id=$sign;
          	$pay->amount=$amount;
          	$pay->order_id=$orderId;
          	$pay->save();
          	$order=order::where(['order_id'=>$orderId])->first();
          	$order->status=1;
          	$order->save();
          	$user=User::find($order->user_id);
          	$email=$user->email;
          	$name=$user->name;
          	$this->sendmail($email,$name,'Payment Successfull','You have complete payment of '.$amount,' for order_id'.$payid);
          	return redirect()->to('razor-thank-you');
          }else{
          	return redirect()->to('failed-payment');
          }
     }
 
     public function RazorThankYou()
     {

        $data['cats']=category::all();
        $data['sections']=widget::all()->pluck("content",'name');
        $data['maincats']=category::where(['parent_id'=>null])->get();
        $data['quantity']=\Cart::getTotalQuantity();
        $br=brand::all()->chunk(3);
    $data['brandlinks']=$br;
    
       return view('thank-you',$data);
     }
     public function saveAddress(Request $request){
	     	 $validated = $request->validate([
	        'email' => 'required',
	        'firstName' => 'required',
			'phonenumber' => 'required',
			'address' => 'required',
			'country' => 'required',
			'state' => 'required',
			'zip' => 'required',
			'user_id'=>'required',
			'semail' => 'required_without:sameaddress',
	        'sfirstName' => 'required_without:sameaddress',
			'sphonenumber' => 'required_without:sameaddress',
			'saddress' => 'required_without:sameaddress',
			'scountry' => 'required_without:sameaddress',
			'sstate' => 'required_without:sameaddress',
			'szip' => 'required_without:sameaddress',
	    ]);

			    $userid=$request->user_id;
			    $email=$request->email;
				 $fname=$request->firstName;
				 $phonenumber=$request->phonenumber;
				 $company=$request->companyName;
				 $address=$request->address2;
				 $state=$request->state;
				 $zip=$request->zip;
				 $country=$request->country;
             $sameaddress=isset($request->sameaddress) ? $request->sameaddress :null;
				 // item
				 $semail=$request->semail;
				 $sfname=$request->sfirstName;
				 $sphonenumber=$request->sphonenumber;
				 $scompany=$request->scompanyName;
				 $saddress=$request->saddress2;
				 $sstate=$request->sstate;
				 $szip=$request->zip;
				 $scountry=$request->scountry;
               $oldaddress=address::where(['name'=>$fname,'street'=>$address,'city'=>$city])->first();
               if($oldaddress!=null){
                 $address1= new address();
		   $address1->name=$fname;
		   $address1->customer_id=$userid;
		   $address1->street=$address;
		   $address1->state=$state;
		   $address1->zip=$szip;
		   $address1->phone=$phonenumber;
		   $address1->city=$request->city;
		   $address1->company=$company;
		   $address1->type=1;
		   $address1->save();
		   $address_id1=$address1->id;
		   $address_id2=null;
		   if($sameaddress==1){

			   $address1= new address();
			   $address1->name=$fname;;
			  $address1->customer_id=$userid;
			   $address1->street=$address;
			   $address1->state=$state;
			   $address1->company=$company;
			   $address1->zip=$zip;
			   $address1->phone=$phonenumber;
			   $address1->city=$request->city;
			   $address1->type=2;
			   $address1->save();
			   $address_id2=$address1->id;

		   }else{
			   $address1= new address();
			   $address1->name=$sfname;;
			   $address1->customer_id=$userid;
			   $address1->street=$saddress;
			   $address1->state=$sstate;
			   $address1->company=$scompany;
			   $address1->zip=$szip;
			   $address1->phone=$sphonenumber;
			   $address1->city=$request->scity;
			   $address1->type=2;
			   $address1->save();
			   $address_id2=$address1->id;
		}
       if($address_id1 && $address_id2){
       	return json_encode(['status'=>1,'address1'=>$address_id1,'address2'=>$address_id2]);
       
       }else{
       	return json_encode(['status'=>0]);
       
       }
               }else{
               return json_encode(['status'=>1,'address1'=>$oldaddress->id,'address2'=>$oldaddress->id]);
       	
               }
		   
        
     }

     public function failedpayment()
     {

        $data['cats']=category::all();
        $data['sections']=widget::all()->pluck("content",'name');
        $data['maincats']=category::where(['parent_id'=>null])->get();
        $data['quantity']=\Cart::getTotalQuantity();
        $br=brand::all()->chunk(3);
    $data['brandlinks']=$br;
    
       return view('failed',$data);
     }
	 
	 public function checkout(Request $request){


	 	die;
	 	$data=common::commonData('category');
		  $validated = $request->validate([
        'address_id1'=>'required',
		'user_id'=>'required',

    ]);
      
		 			 
		 $order=new order();
		 $data['items'] = \Cart::getContent();
		 $data['total']=\Cart::getTotal();
		 $data['quantity']=\Cart::getTotalQuantity();
          $order->customer_id=$userid;
          $order->quantity= $data['quantity'];
		  //$order->quantity= $data['quantity'];
      $trid=substr(bin2hex(openssl_random_pseudo_bytes(24)),0,12);    
		  $order->transaction_id= $trid;
		$order->amount=$data['total'];
		$order->status=3;
		$order->save();
		$orderId=$order->id;

      foreach($data['items'] as $item){

    	$item=orderItem::create(['order_id'=>$orderId,'quantity'=>$item->quantity ?? 1,'product_id'=>$item->id,'itemdata'=>json_encode($item->attributes->toArray())]);

    } 

       DB::table('order_address')->insert(['order_id'=>$orderId,'address_id'=>$request->address_id1,'delivery_instruction'=>$request->delivery_inst]);

		
		  

      $api = new Api("rzp_test_sUqjzvuqWL0242", "G9MUw4cKlM9bJkgrC5ftPUAA");
		  $res=$api->order->create(array('receipt' => $trid, 'amount' => $data['total']*100, 'currency' => 'INR','payment_capture' => 1));
		  $order=order::find($orderId);
      $order->order_id=$res->id;
      $order->save();
      $razorpayOrderId=$res->id;
     $data1 = [
    "key"               => "rzp_test_sUqjzvuqWL0242",
    "amount"            => $data['total'],
    "prefill"           => [
    "name"              => $fname,
    "email"             => $email,
    ],
    "notes"             => [
    "address"           => $address,
    "merchant_order_id" => $trid,
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];


        
        $data['quantity']=\Cart::getTotalQuantity();

   $json = json_encode($data1);
   $data['json']=$json;
   $data['amount']=$data['total'];
   $data['order_id']=$order->order_id;
   return view("paynow",$data);
   

		   
		   
           		   
		 
	 }

     public function test(){
		      
		$api = new Api("rzp_test_sUqjzvuqWL0242", "G9MUw4cKlM9bJkgrC5ftPUAA");
		$res=$api->order->create(array('receipt' => '123', 'amount' => 100, 'currency' => 'INR', 'notes'=> array('key1'=> 'value3','key2'=> 'value2')));
		print_r($res->id);
		
	 }
	 	 
		public function buynow(Request $request){

			 $id=$request->id;
			 $product=product::find($id);
		     if($product){
		        \Cart::add(array(
		            'id' => $product->id,
		            'name' => $product->title,
		            'price' => $product->regular_price,
		            'quantity' => 1,
		             'attributes' => array("image"=>$product->pimage->image ?? '','discount'=>$product->discount),
		            'associatedModel' => $product
		        ));
		     }
           return redirect()->to('checkout');
		}
     
 
 }
?>