<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use App\Models\brand;

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
        $data['featured_products']=product::where(['featured'=>'1'])->get();
        $data['featured_products']=product::where(['bestseller'=>'1'])->get();
        $data['cats']=category::all();
        $data['brands']=brand::all();
        return view('home',$data);
    }

    public function home()
    {
        $data['featured_products']=product::where(['featured'=>'1'])->get();
        $data['featured_products']=product::where(['bestseller'=>'1'])->get();
        $data['cats']=category::all();
        $data['brands']=brand::all();
        return view('welcome',$data);
    }
}
