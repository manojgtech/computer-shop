@extends('layouts.home')

@section('content')

    <div class="mmd-home-slider">
        <div class="swiper" id="mmd-homepage-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="//picsum.photos/1920/1080" class="w-100 img-fluid" >
                </div>
                <div class="swiper-slide">
                    <img src="//picsum.photos/1920/1080" class="w-100 img-fluid" >
                </div>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-9 col-lg-9 col-xl-9 pe-md-4 border-md-end">
                <div class="d-flex flex-wrap justify-content-md-between justify-content-between py-3">
                    <h4 class="text-white h2 fw-bold">Hot <span class="text-orange">Deals</span></h4>
                    <div class="nav-pills nav">
                        
                         @if($hotdeals)
                         @foreach($hotdeals as $deal)
                        <a href="#deal{{$loop->iteration}}" class="nav-link nav-item {{$loop->iteration==1 ? 'active':''}}" data-bs-toggle="pill">{{$deal->name}}</a>
                        @endforeach 
                        @endif 
                         
                        
                    </div>
                </div>
                <div class="tab-content innertab-content">
                    <!-- deal div -->
                    @if($hotdeals)
                    @foreach($hotdeals as $deal)
                    <div class="tab-pane fade show {{$loop->iteration==1 ? 'active':''}}" id="deal{{$loop->iteration}}">
                        <img src="{{url("brands/".$deal->image)}}" alt="{{$deal->name}}" class="img-fluid w-100 shadow mb-4 d-block brandimg">
                        <!-- <div class="nav-pills nav mb-3" style="display:none;">
                            <a href="#ideal1" class="nav-link nav-item active" data-bs-toggle="pill">Inner Deal 1</a>
                            <a href="#ideal2" class="nav-link nav-item" data-bs-toggle="pill">Inner Deal 2</a>
                            <a href="#ideal3" class="nav-link nav-item" data-bs-toggle="pill">Inner Deal 3</a>
                            <a href="#ideal4" class="nav-link nav-item" data-bs-toggle="pill">Inner Deal 4</a>
                        </div> -->
                        <div class="tab-content">
                            <div class="tab-pane fade show {{$loop->iteration==1 ? 'active':''}}">
                                <div class="swiper" id="product-slider-1">
                                    <div class="swiper-wrapper">
                                        @php
                                         $pids=$deal->productList();
                                        @endphp
                                        @if($pids)
                                        @foreach($pids as $pid)
                                        <div class="swiper-slide">
                                            <div class="mmd-product-vertical">
                                                <div class="product-top">
                                                    <span class="off-tag">{{$deal->discount}}%</span>
                                                    
                                                    <img src="{{$pid->pimage!=null ? url("brands/".$pid->pimage->image) : url('brands/defaultpc.png')}}" alt="{{$pid->title}}" class="img-fluid w-100">
                                                </div>
                                                <div class="product-bottom">
                                                    <h4 class="mmd-product-category">{{$pid->category->name}}</h4>
                                                    <p class="mmd-product-name">{{$pid->title}}</p>
                                                    <ul class="mmd-product-rating d-flex list-unstyled pl-0 mb-0">
                                                        <li><a href=""><i class="bi-star"></i></a></li>
                                                        <li><a href=""><i class="bi-star"></i></a></li>
                                                        <li><a href=""><i class="bi-star"></i></a></li>
                                                        <li><a href=""><i class="bi-star"></i></a></li>
                                                        <li><a href=""><i class="bi-star"></i></a></li>
                                                    </ul>
                                                    @php
                                                    $perc=$deal->discount;
                                                    $price=$pid->regular_price;
                                                    $nprice=round($price+$price*$perc/100);

                                                    @endphp
                                                    <p class="mmd-product-price"><span class="old-price">${{$price}}</span><span class="new-price">${{$nprice}}</span></p>
                                                    <a href="" class="bg-orange btn text-dark"><i class="bi-cart"></i> Add to Cart</a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach 
                    @endif 
                        
                    <!--end deal div-->
                    
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 ps-md-4">
                <h4 class="text-white h3 fw-bold mb-4 pt-3">Special <span class="text-orange">Offers</span></h4>
                <ul class="list-unstyled mb-0 pl-0">
                    @if($special_offers)
                   
                    @php
                    $pids=$special_offers->productList();
                    @endphp
                    @if($pids)
                    @foreach($pids as $pid)
                    
                        <div class="mmd-product-horizontal">
                            <img src="{{$pid->pimage!=null ? url("brands/".$pid->pimage->image) : url('brands/defaultpc.png')}}" class="w-100 rounded" alt="{{$pid->title}}">
                            <div class="mmd-product-description">
                                <p>{{$pid->title}}</p>
                                <ul class="list-unstyled d-flex mb-0 pl-0">
                                    <li><a href=""><i class="bi-star me-1"></i></a></li>
                                    <li><a href=""><i class="bi-star me-1"></i></a></li>
                                    <li><a href=""><i class="bi-star me-1"></i></a></li>
                                    <li><a href=""><i class="bi-star me-1"></i></a></li>
                                    <li><a href=""><i class="bi-star me-1"></i></a></li>
                                </ul>
                                @php
                                $perc=$special_offers->discount;
                                $price=$pid->regular_price;
                                $nprice=round($price+$price*$perc/100);

                                 @endphp
                                <div class="mmd-product-price">
                                    <span class="old-price">${{$price}}</span>
                                    <span class="new-price">${{$nprice}}</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @endif
                    @endif
                </ul>
            </div>
        </div>
        <div class="py-5">
            <h4 class="h2 text-white fw-bold border-bottom-2">Featured <span class="text-orange">Brands</span></h4>
            <div class="row">
                <div class="col-12">
                    <div id="featured-brands-slider">
                        @if($brands)
                        @foreach($brands as $brand)
                        <img src="{{url("brands/".$brand->logo)}}" alt="{{$brand->name}}" class="w-100">
                        @endforeach
                        @endif
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5">
            <h4 class="h2 text-white fw-bold border-bottom-2">Trending <span class="text-orange">Products</span></h4>
            <div class="row">
                <div class="col-12">
                    <div class="swiper" id="product-slider-2">
                        <!-- featured -->
                       
                        <div class="swiper-wrapper">
                        @if($featuredproducts)
                         @foreach($featuredproducts as $prd)
                            <div class="swiper-slide">
                                <div class="mmd-product-vertical">
                                    <div class="product-top">
                                        <span class="off-tag">{{$prd->discount}}%</span>
                                        <img src="{{$prd->pimage!=null ? url("brands/".$prd->pimage->image) : url('brands/defaultpc.png')}}" alt="{{$prd->title}}" class="img-fluid w-100">
                                    </div>
                                    <div class="product-bottom">
                                        <h4 class="mmd-product-category">{{$prd->category->name}}</h4>
                                        <p class="mmd-product-name">{{ucwords($prd->title)}}</p>
                                        <ul class="mmd-product-rating d-flex list-unstyled pl-0 mb-0">
                                            <li><a href=""><i class="bi-star"></i></a></li>
                                            <li><a href=""><i class="bi-star"></i></a></li>
                                            <li><a href=""><i class="bi-star"></i></a></li>
                                            <li><a href=""><i class="bi-star"></i></a></li>
                                            <li><a href=""><i class="bi-star"></i></a></li>
                                        </ul>
                                        @php
                                        $price=$prd->regular_price+round($prd->regular_price*$prd->discount/100);
                                        @endphp
                                        <p class="mmd-product-price"><span class="old-price">${{$prd->regular_price}}</span><span class="new-price">${{$price}}</span></p>
                                        <a href="" class="bg-orange rounded p-2 text-dark"><i class="bi-cart"></i> Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @endif
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="my-5">
            <img src="https://via.placeholder.com/1000x350?text=Category Banner" alt="" class="mmd-hompage-banner2 w-100 img-fluid">
        </div>
        <div class="py-5">
            <h4 class="h2 text-white fw-bold mb-4">Product <span class="text-orange">Categories</span></h4>
            <div class="swiper" id="category-slider">
                <div class="swiper-wrapper">
                @if($cats)
                          @foreach($cats as $cat)
                    <div class="swiper-slide">
                        <div class="mmd-product-categories">
                            <a href="{{route('category',['category'=>urlencode($cat->slug)])}}">
                                <img src="assets/img/category-placeholder.png" alt="" class="w-100">
                                <h4>{{$cat->name}}</h4>
                            </a>
                        </div>
                    </div>
                    @endforeach
                @endif
                   
                </div>
            </div>
        </div>
        <div class="py-5">
            <h4 class="h2 text-white fw-bold border-bottom-2">Products You may <span class="text-orange">Like</span></h4>
            <div class="row">
                @if($featuredproducts)
                 @foreach($randomproducts as $prd)
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="mmd-product-vertical dark">
                        <div class="product-top">
                            <span class="off-tag">{{$prd->discount}}%</span>
                            <img src="{{$prd->pimage!=null ? url("brands/".$prd->pimage->image) : url('brands/defaultpc.png')}}" alt="{{ucwords($prd->title)}}" class="img-fluid w-100">
                        </div>
                        <div class="product-bottom">
                            <h4 class="mmd-product-category">{{$prd->category->name}}</h4>
                            <p class="mmd-product-name">{{ucwords($prd->title)}}</p>
                            <ul class="mmd-product-rating d-flex list-unstyled pl-0 mb-0">
                                <li><a href=""><i class="bi-star"></i></a></li>
                                <li><a href=""><i class="bi-star"></i></a></li>
                                <li><a href=""><i class="bi-star"></i></a></li>
                                <li><a href=""><i class="bi-star"></i></a></li>
                                <li><a href=""><i class="bi-star"></i></a></li>
                            </ul>
                            @php
                              $price=$prd->regular_price+round($prd->regular_price*$prd->discount/100);
                            @endphp
                            <p class="mmd-product-price"><span class="old-price">${{$prd->regular_price}}</span><span class="new-price">${{$price}}</span></p>
                            <a href="" class="bg-orange btn text-dark"><i class="bi-cart"></i> Add to Cart</a>
                        </div>
                    </div>
                </div>
                 @endforeach
                @endif
                           </div>
        </div>
    </div>

 
@endsection

