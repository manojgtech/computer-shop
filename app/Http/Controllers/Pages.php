<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\page;
use App\Models\category;
use App\Models\brand;
use App\Models\deal;
use App\Models\widget;
use Illuminate\Support\Facades\DB;

class Pages extends Controller
{
    public function page(Request $request){
        $data['cats']=category::all();
        $data['sections']=widget::all()->pluck("content",'name');
        $data['maincats']=category::where(['parent_id'=>null])->get();
         $data['quantity']=\Cart::getTotalQuantity();
         $br=brand::all()->chunk(3);
    $data['brandlinks']=$br;
    
        $slug=isset($request->slug) ? $request->slug:null;
        if($slug){
        $page=page::where(['slug'=>$slug])->first();
        if($page){
            $data['title']=$page->title;
            $data['content']=$page->content;
            return view('page',$data);
        }else{
            echo "No page found";
        }
        
        }
    }

    function  subscribList(Request $request){
        $email=$request->email;
        echo DB::table("email_list")->insert(['email'=>$email]);

    }
}
