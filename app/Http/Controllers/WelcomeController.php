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
use DB;

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
           
        
         $data['faqs']=null;
         if($slug){
         $data['product']=PreownedPC::where(['slug'=>$slug])->first();
          $prc=json_decode($data['product']->processors,true);
          $prc=array_map('intval', $prc);
        // print_r( $data['product']);
         $data['processors']=Processor::whereIn("id",$prc)->get();
         //rams
        
         $rms=json_decode($data['product']->ram,true);
          $rms=array_map('intval', $rms);
         $data['rams']=Ram::whereIn("id",$rms)->get();
         //grap
         
         $gr=json_decode($data['product']->graphics,true);
          $gr=array_map('intval', $gr);
        
         $data['graphics']=Graphics::whereIn("id",$gr)->get();
         $hd=json_decode($data['product']->hdd,true);
         $hd=array_map('intval', $hd);
       
         $data['hdds']=HardDisks::whereIn("id",$hd)->get();
         $wf=json_decode($data['product']->wifi,true);
         $hd=array_map('intval', $wf);
       
         $data['wifis']=wifi::whereIn("id",$wf)->get();
         }else{
            echo "404"; die;
        }
         return view('preownedpc1',$data);
    }

    
}
