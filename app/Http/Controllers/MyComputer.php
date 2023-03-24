<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use App\Models\brand;
use App\Models\deal;
use App\Models\widget;
use App\Models\common;

class MyComputer extends Controller
{
    public function index(Request $request){
 $data=common::commonData('category');
        // $data['cats']=category::all();
        // $data['sections']=widget::all()->pluck("content",'name');
        // $data['maincats']=category::where(['parent_id'=>null])->get();
        // $data['quantity']=\Cart::getTotalQuantity();
        return view('custombuildpc',$data);
    }
}
