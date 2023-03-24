@extends('layouts.home')

@section('content')
     
<style>
    label{
        color: #fff;
    }
    .product-section:before {
    content: '';
    position: absolute;
    width: 1px;
    height: 88.5%;
    top: 70px;
    left: -4px;
    display: none;
    background-color: #fff;
}
</style>
<main class="category">
    <div class="category-header  d-flex justify-content-center align-items-center">
        <h3 class="my-4 display-5 fw-bold">Wishlist</h3>
    </div>
    <div class="product-listing">
        <section class="product-listing-area">
            <div class="container">
                <div class="row" style="--bs-gutter-x: 0;
    --bs-gutter-y: 0;">
                    
                    <div class="col-lg-12">
                        <section class="product-section">
                            <div class="row">
                          @if($npcs)
                           @foreach($npcs as $prd1){
                            @php $prd= $prd1->product; @endphp
                                <div class="col-md-2">

                                <a href="{{url("preowned-pc-single/".$prd->slug)}}">
                                <div class="mmd-product-vertical">
                                    <div class="product-top">
                                        
                                        <img src="{{$prd->defaultpic!=null ? url("brands/".$prd->defaultpic) : url('brands/defaultpc.png')}}" alt="{{$prd->title}}" class="img-fluid w-100">
                                    </div>
                                    <div class="product-bottom">
                                        
                                        <p class="mmd-product-name">{{ucwords($prd->title)}}</p>
                                        <p class="mmd-product-price"><span class="old-price">₹{{$prd->price}}</span><span class="new-price">₹{{$prd->sell_price}}</span></p>
                                    </div>
                                </div>
                            </a>
                                </div>
                              @endforeach
                              @endif
                               
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection