<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jackiedo\Cart\Facades\Cart;

class CartController extends Controller
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart   = Cart::name('shopping');
    }

    public function content()
    {
        $variable = $this->cart->doSomething();
    }

    public function addItem()
    {
        $variable = $this->cart->doSomething();
    }
}
