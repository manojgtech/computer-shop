<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use App\Models\product;
use App\Models\category;
use App\Models\brand;
use App\Models\User;
use App\Models\query;
use App\Models\common;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    public function dashboard(Request $request){
        $data=common::commonData('category');
         $userid=Auth::id();
         $data['orders']=order::orderBy("id","asc")->get();
         $data['featured_products']=product::where(['featured'=>'1'])->get();
         $data['featured_products']=product::where(['bestseller'=>'1'])->get();
         $data['cats']=category::all();
         $data['user']=Auth::user();
         $data['quantity']=\Cart::getTotalQuantity();
         $data['brands']=brand::all();
          return view('home',$data);
       
    }

    public function orders(Request $request){
         $userid=Auth::id();
         $data['orders']=order::all();
         $data['featured_products']=product::where(['featured'=>'1'])->get();
         $data['featured_products']=product::where(['bestseller'=>'1'])->get();
         $data['cats']=category::all();
         $data['quantity']=\Cart::getTotalQuantity();
         $data['brands']=brand::all();
         return view('home',$data);   
    }

   public function updateProfile(Request $request){
           $validator = $request->validate([
            'name' => 'required', 
            'email' => 'required|email', 
            'phone' => 'required|max:13',
            'id'    =>  'required'

        ]);

        
            $name=$request->name;
            $email=$request->email;
            $phone=$request->phone;
            $id=isset($request->id) ? $request->id : null;
            $user=User::find($id);
            if($user){
              
               $user->email=$email;
               $user->phone=$phone;
               $user->name=$name;
                $cpwd=isset($request->cpwd) ? $request->cpwd:null;
                $npwd=isset($request->npwd) ? $request->npwd:null;
                if($npwd && $cpwd){
                    $pwd=$user->password;
                    if($pwd==$cpwd){
                        $user->password=$npwd;
                    }
                }
                $user->save();
                return redirect()->back()->with('message', 'Profile updated');
            
            
            

        }

    }

       public  function supportForm(Request $request){
           $validator = $request->validate([
            'name' => 'required', 
            'email' => 'required|email', 
            'subject' => 'required',
            'message'    =>  'required'

        ]);

        
            $name=$request->name;
            $email=$request->email;
            $subject=$request->subject;
            $message=$request->subject;
            //$id=isset($request->id) ? $request->id : null;
            $user=new query;
            if($user){
              
               $user->email=$email;
               $user->name=$name;
               $user->subject=$subject;
               $user->message=$message;
                $user->save();
                return redirect()->back()->with('message', 'Message sent');
            
            
            

        }

   }

}
