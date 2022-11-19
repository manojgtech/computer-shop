<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use App\Models\brand;
use Illuminate\Support\Facades\Auth;
use App\Models\order;
use App\Models\User;
use App\Models\common;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         $data=common::commonData('category');
         
         $userid=Auth::id();
         $data['userid']=$userid;
         $data['orders']=order::orderBy("id","asc")->get();

         $data['user']=Auth::user();
         
    
        return view('home',$data);
    }

    public function home()
    {
        $data['featured_products']=product::where(['featured'=>'1'])->get();
        $data['featured_products']=product::where(['bestseller'=>'1'])->get();
        $data['cats']=category::all();
        $data['brands']=brand::all();
        $br=brand::all()->chunk(3);
    $data['brandlinks']=$br;
    
        return view('welcome',$data);
    }
}
