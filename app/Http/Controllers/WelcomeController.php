<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use App\Models\brand;
use App\Models\deal;
use App\Models\widget;
use App\Models\common;
use App\Models\Processor;
use App\Models\Ram;
use App\Models\HardDisks;
use App\Models\Graphics;
use App\Models\PreownedPC;
use Illuminate\Support\Facades\Auth;
use App\Models\wifi;

class WelcomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data=common::commonData('home');
        $data['featuredproducts']=product::where(['featured'=>'1'])->get();
        $data['bestproducts']=product::where(['bestseller'=>'2'])->get();
        $data['cats']=category::all()->take(10);
        $data['topcats10']=category::whereNull('parent_id')->take(3)->get();
        $data['brands']=brand::all();
        $data['hotdeals']=deal::where(['type'=>'1'])->get();
        $data['special_offers']=deal::where(['type'=>'3'])->first();
        $data['randomproducts']=product::inRandomOrder()->take(20)->get()->chunk(10);
        return view('welcome',$data);
    }

    public function preowned(Request $request){
         $data=common::commonData('home');
         $data['npcs']=PreownedPC::all();  
         $data['processors']=Processor::all();
         $data['rams']=Ram::all();
         $data['graphics']=Graphics::all();
         $data['hdds']=HardDisks::all();
         return view('preowned',$data);


    }

    function singlepreowned(Request $request){
         $slug=$request->slug ?? null;
         $data=common::commonData('home');
           
         $data['processors']=Processor::all();
         $data['rams']=Ram::all();
         $data['graphics']=Graphics::all();
         $data['hdds']=HardDisks::all();
         $data['wifis']=wifi::all();
         $data['faqs']=null;
         if($slug){
         $data['product']=PreownedPC::where(['slug'=>$slug])->first();
         }else{
            echo "404"; die;
        }
         return view('preownedpc1',$data);
    }

    
}
