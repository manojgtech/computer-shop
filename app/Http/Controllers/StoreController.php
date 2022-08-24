<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use App\Models\brand;

class StoreController extends Controller
{
    public function categories(Request $request){
         $category=$request->category;
         $cat=category::where(['slug'=>$category])->first();
         $prds=product::where(['category_id'=>$cat->id])->get();
         print_r($prds);
        // return view('welcome',$data);

    }

    public function brands(Request $request){
            echo "brands";
    }
}
