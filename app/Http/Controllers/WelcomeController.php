<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use App\Models\brand;
use App\Models\deal;
use App\Models\widget;

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
        $data['featuredproducts']=product::where(['featured'=>'1'])->get();
        $data['bestproducts']=product::where(['bestseller'=>'2'])->get();
        $data['cats']=category::all();
        $data['brands']=brand::all();
        $data['hotdeals']=deal::where(['type'=>'1'])->get();
        $data['special_offers']=deal::where(['type'=>'3'])->first();
        $data['randomproducts']=product::inRandomOrder()->get();
        $data['sections']=widget::all()->pluck("content",'name');
        //dd($data['sections']);
        $data['maincats']=category::where(['parent_id'=>null])->get();
        return view('welcome',$data);
    }

    
}
