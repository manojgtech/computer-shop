@extends('layouts.home')

@section('content')

<main class="category">
    <div class="category-header  d-flex justify-content-center align-items-center">
        <h3 class="my-4 display-5 fw-bold">Search Results for :{{$q}}</h3>
    </div>
    <div class="product-listing">
        <section class="product-listing-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="categories-list callist1">
                            <h4>Product Categories</h4>
                            <ul>
                                @if($cats)
                                @foreach($maincats as $cat)
                                <li>
                                    <a href="{{route('category',['category'=>$cat->slug])}}" >{{ucwords($cat->name)}}</a>
                                </li>
                                @endforeach
                                @endif
                                
                            </ul>
                        </div>
                       
                    </div>
                    <div class="col-lg-9">
                        <section class="product-section">
                            
                            <div class="row" id="cproddiv">
                                @if(count($products)>0)
    @foreach($products as $product)
    <div class="col-md-3 col-lg-3 col-sm-6">
        <div class="mmd-product-vertical">
            <div class="product-top">
                <span class="off-tag">{{$product->discount}}%</span>
                <a href="{{route("product",['slug'=>$product->slug])}}" ><img lazy data-original="{{$product->defaultpic!=null ? url("brands/".$product->defaultpic) : url('brands/defaultpc.png')}}" alt="{{$product->title}}" class="img-fluid w-100 lazy"></a>
            </div>
            <div class="product-bottom">
                @if($product->category)
                <h4 class="mmd-product-category">{{ucwords($product->category->name)}}</a></h4>
                @endif
                <p class="mmd-product-name"><a href="{{route("product",['slug'=>$product->slug])}}" >{{ucwords($product->title)}}</a></p>
                <ul class="mmd-product-rating d-flex list-unstyled pl-0 mb-0">
                    <li><a href=""><i class="bi-star"></i></a></li>
                    <li><a href=""><i class="bi-star"></i></a></li>
                    <li><a href=""><i class="bi-star"></i></a></li>
                    <li><a href=""><i class="bi-star"></i></a></li>
                    <li><a href=""><i class="bi-star"></i></a></li>
                </ul>
                       @if($product->variant && count($product->variant)>0)
<a href="{{route("product",['slug'=>$product->slug])}}" class="bg-orange btn text-dark seeopt">See Options</a>
    @else
                <p class="mmd-product-price"><span class="old-price">₹{{$product->regular_price}}</span><span class="new-price">₹{{$product->regular_price-($product->regular_price*$product->discount/100)}}</span></p>
                <a data-id={{$product->id}} onClick="addtocart(this);" class="bg-orange rounded p-2 text-dark"><i class="bi-cart"></i> Add to Cart</a>
        @endif        
            </div>
        </div>
    </div>
    @endforeach
    @else
    <div class="col-md-8 alert alert-info">
         no product found
    </div>
    @endif


 
                             </div>
                             
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection