@extends('layouts.home')

@section('content')
<section class="h-100">
  <div class="container-fluid">
    <div class="row d-flex" style="margin: 25px;">
      <div class="col-8">

        <div class="d-flex justify-content-between align-items-center mb-4 WishListController">
          <h3 class="fw-normal mb-0 text-white"><strong>Shopping Cart ({{$quantity}} Items)</strong></h3>
          
        </div>
        
        @if(count($items)>0)
         
        @php
        $dis=true;
        @endphp
        @foreach($items as $item)
        @if($loop->iteration==1)
         <div class="card rounded-3 mb-4">
<div class="row d-flex justify-content-between align-items-center" style="padding: 15px;">
              <div class="col-md-6 col-lg-6 col-xl-6">
                 <strong>Product</strong>
              </div>

              <div class="col-md-2 col-lg-2 col-xl-2">
                    <strong>Price</strong>
              </div>
              <div class="col-md-2 col-lg-2 col-xl-2">
                 <strong>Quantity</strong>
              </div>
              <div class="col-md-2 col-lg-2 col-xl-2">
                 <strong>Subtotal</strong>
              </div>
         </div>
        @endif
        <div class="card rounded-3 mb-4" id="cart{{$item->id}}">

          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2">
                <img
                  src="{{$item->associatedModel->defaultpic ? url('brands/'.$item->associatedModel->defaultpic) : url('brands/defaultpc.png')}}"
                  class="img-fluid rounded-3" alt="{{$item->name}}">
              </div>
              <div class="col-md-4 col-lg-4 col-xl-4">
                <p class="fw-normal mb-2">{{$item->name}} 
                    @if($item->attributes->value) 
                       ({{$item->attributes->value}})
                       @endif
                </p>
                <p class="d-none"><span class="text-muted">Size: </span>M <span class="text-muted">Color: </span>Grey</p>
               <p class="cartbtns"> <a class=" btn  btn-danger" onclick="addWishlist({{$item->id}});">Move to wishlist</a>
                <a class="btn  btn-danger" onclick="deleteCart({{$item->id}});"><i class="fa fa-times"></i>&nbsp;Remove</a></p>
              
              </div>

              <div class="col-md-2 col-lg-2 col-xl-2">
                <h5 class="mb-0">₹ @if($item->attributes->sprice) 
                       {{$item->attributes->sprice}}
                       @else {{$item->price}} @endif </h5>
              </div>
              <div class="col-md-2 col-lg-2 col-xl-2 d-flex">
                <button class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepDown();updateCart({{$item->id}},2);">
                  <i class="fa fa-minus"></i>
                </button>

                <input id="cartqty{{$item->id}}" readonly min="0" name="quantity" data-id="{{$item->id}}" onchange="updateCart();" value="{{$item->quantity}}" type="number"
                  class="form-control form-control-sm" />

                <button class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepUp();updateCart({{$item->id}},1);">
                  <i class="fa fa-plus"></i>
                </button>
              </div>

              <div class="col-md-2 col-lg-2 col-xl-2  totam" data-val="{{$item->price}}">
                <h5 class="mb-0 ttam">₹ @if($item->attributes->sprice) 
                       {{$item->attributes->sprice*$item->quantity}}
                        @else {{$item->price*$item->quantity}} @endif </h5>
              </div>
              
             
            </div>
          </div>
        </div>
        @endforeach
        @else
        @php
        $dis=false;
        @endphp
        <div class="card rounded-3 mb-3" id="">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2">
                <img
                  src="{{url('assets/img/nocart.png')}}"
                  class="img-fluid rounded-3" alt="empty cart">
              </div>
              <div class="col-md-3 col-lg-3 col-xl-3">
                <p class="lead fw-normal mb-2">No item in cart</p>
                <p class="d-none"><span class="text-muted">Size: </span>M <span class="text-muted">Color: </span>Grey</p>
              </div>
              <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                
              </div>
              
              
            </div>
          </div>
        </div>
        @endif


        
       
      </div>
      

    </div>
    <div class="col-md-4">
       @if($dis)
        <div class="card mb-4">
          <div class="card-header">
            <h4 class="text-center card-title txtyellow">Summary</h4>
          </div>
           <div class="card-body"><p>Items({{$quantity}}) <span class="txtyellow pull-right">₹{{$amount}}</span></p></div>
          <div class="card-body p-4 d-flex flex-row">

            
            <div class="form-outline flex-fill">
              <label class="form-label" for="form1"><strong>Apply Promo Code</strong></label>
              <br/>
              <input type="text" id="form1" class="form-control form-control-lg" />
              
            </div>
            <button type="button" style="height: 47px;
    margin-left: 4px;margin-top: 30px;" class="btn btn-warning btn-block btn-lg">Apply</button>
            

          </div>
          <div class="card-body">
            <button type="button" class="btn btn-warning btn-block btn-lg"><a href="{{route('checkout')}}">Proceed to Pay<a/></button>
          </div>
        </div>

       
     @endif
      </div>
  </div>
  <!-- modal -->
   
  <!-- end modal -->
</section>
@endsection