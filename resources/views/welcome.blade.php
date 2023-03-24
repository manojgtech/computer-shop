@extends('layouts.home')

@section('content')
  
    <div class="mmd-home-slider">
        <div class="swiper" id="mmd-homepage-slider">
            <div class="swiper-wrapper">
                @if(@home_banners)
                @foreach($home_banners as $img)
                <div class="swiper-slide">
                    <img src="{{url('brands/'.$img->image)}}" class="w-100 img-fluid bannerimg" >
                </div>
                @endforeach
                @endif
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
                    <div class="nav-pills nav" id="dealtabts">
                        
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
                        
                       
                                <div class="swiper product-slider-1" id="product-slider{{$loop->iteration}}">
                                   
                                    <div class="swiper-wrapper">
                                        @php
                                         $pids=$deal->productList();
                                        @endphp
                                        @if($pids)
                                        @foreach($pids as $pid)
                                        <div class="swiper-slide">
                                             <a href="{{route("product",['slug'=>$pid->slug])}}">
                                            <div class="mmd-product-vertical">
                                                <div class="product-top">
                                                    <span class="off-tag">{{$deal->discount}}%</span>
                                                    
                                                    <img src="{{$pid->defaultpic!=null ? url("brands/".$pid->defaultpic) : url('brands/defaultpc.png')}}" alt="{{$pid->title}}" class="img-fluid w-100">
                                                </div>
                                                <div class="product-bottom">
                                                    <h4 class="mmd-product-category">{{isset($pid->category) ? $pid->category->name : 'No category'}}</h4>
                                                    <p class="mmd-product-name"><a href="{{route("product",['slug'=>$pid->slug])}}" >{{$pid->title}}</a></p>
                                                    <ul class="mmd-product-rating d-flex list-unstyled pl-0 mb-0 d-none">
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
                                                    @if($pid->variant && count($pid->variant)>0)
                                                    <p class="mmd-product-price"><span class="old-price">₹{{$price}}</span><span class="new-price">₹{{$nprice}}</span></p>
<a href="{{route("product",['slug'=>$pid->slug])}}" class="bg-orange btn text-dark seeopt">See Options</a>
                                                     @else
                                                    <p class="mmd-product-price"><span class="old-price">₹{{$price}}</span><span class="new-price">₹{{$nprice}}</span></p>
                                                    <a data-id={{$pid->id}} onClick="addtocart(this);" class="bg-orange btn text-dark"><i class="bi-cart"></i> Add to Cart</a>
                                                   


                                                    @endif
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                    
                                        @endforeach
                                        @endif
                                    </div>
                                    <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        
                    @endforeach 
                    @endif 
                        
                    <!--end deal div-->
                    
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 ps-md-4">
                <h4 class="text-white h3 fw-bold mb-4 pt-3">Special <span class="text-orange">Offers</span></h4>
                <ul class="list-unstyled mb-0 pl-0" id="splofferdiv">
                    @if($special_offers)
                   
                    @php
                    $pids=$special_offers->productList();
                    @endphp
                    @if($pids)
                    @foreach($pids as $pid)
                        
                        <div class="mmd-product-horizontal">
                            <a href="{{route('product',['slug'=>$pid->slug])}}">
                            <img src="{{$pid->defaultpic!=null ? url('brands/'.$pid->defaultpic) : url('brands/defaultpc.png')}}" class="w-100 rounded" alt="{{$pid->title}}" />
                            <div class="mmd-product-description">
                                <p><a href="{{route('product',['slug'=>$pid->slug])}}" >{{$pid->title}}</a></p>
                                <!-- <ul class="list-unstyled d-flex mb-0 pl-0">
                                    <li><a href=""><i class="bi-star me-1"></i></a></li>
                                    <li><a href=""><i class="bi-star me-1"></i></a></li>
                                    <li><a href=""><i class="bi-star me-1"></i></a></li>
                                    <li><a href=""><i class="bi-star me-1"></i></a></li>
                                    <li><a href=""><i class="bi-star me-1"></i></a></li>
                                </ul> -->
                                @php
                                $perc=$special_offers->discount;
                                $price=$pid->regular_price;
                                $nprice=round($price+$price*$perc/100);

                                 @endphp
                                <div class="mmd-product-price">
                                    <span class="old-price">₹{{$price}}</span>
                                    <span class="new-price">₹{{$nprice}}</span>
                                </div>
                            </div>
                           </a>
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
                    <div id="featured-brands-slider" class="swiper">
                         
                                  <div class="swiper-wrapper">   
                        @if($brands)
                        @foreach($brands as $brand)
                            <div class="swiper-slide">
                            <a href="{{route('brand',['brand'=>$brand->slug])}}"><img src="{{url("brands/".$brand->logo)}}" alt="{{$brand->name}}" class="w-100"></a>
                            </div>
                        @endforeach
                        @endif
                       </div>
                       <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
                    </div>
                </div>

                
            </div>
            <br/>
            <div class="row">
                @if($brand_banner)
                <div class="col-12">
                
                 <img src="{{url('brands/'.$brand_banner->image)}}" style="width: 100%;" class="img img-responsive bannerimg brandadimg">
                
                </div>
               @endif 
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
                                <a href="{{route("product",['slug'=>$prd->slug])}}">
                                <div class="mmd-product-vertical">
                                    <div class="product-top">
                                        <span class="off-tag">{{$prd->discount}}%</span>
                                        <img src="{{$prd->defaultpic!=null ? url("brands/".$prd->defaultpic) : url('brands/defaultpc.png')}}" alt="{{$prd->title}}" class="img-fluid w-100">
                                    </div>
                                    <div class="product-bottom">
                                        <h4 class="mmd-product-category">{{isset($prd->category) ? $prd->category->name:'No category'}}</h4>
                                        <p class="mmd-product-name">{{ucwords($prd->title)}}</p>
                                        <ul class="mmd-product-rating d-flex list-unstyled pl-0 mb-0">
                                            <li><a href=""><i class="bi-star"></i></a></li>
                                            <li><a href=""><i class="bi-star"></i></a></li>
                                            <li><a href=""><i class="bi-star"></i></a></li>
                                            <li><a href=""><i class="bi-star"></i></a></li>
                                            <li><a href=""><i class="bi-star"></i></a></li>
                                        </ul>
                                        @php
                                        $price=$prd->regular_price-round($prd->regular_price*$prd->discount/100);
                                        @endphp
                                        @if($prd->variant && count($prd->variant)>0)
                                        <p class="mmd-product-price"><span class="old-price">₹{{$prd->regular_price}}</span><span class="new-price">₹{{$price}}</span></p>
<a href="{{route("product",['slug'=>$prd->slug])}}" class="bg-orange btn text-dark seeopt">See Options</a>
                                                     @else
                                        <p class="mmd-product-price"><span class="old-price">₹{{$prd->regular_price}}</span><span class="new-price">₹{{$price}}</span></p>
                                        <a data-id={{$prd->id}} onClick="addtocart(this);" class="bg-orange rounded p-2 text-dark"><i class="bi-cart"></i> Add to Cart</a>
                                        @endif
                                    </div>
                                </div>
                            </a>
                            </div>
                        @endforeach
                        @endif
                        </div>
                        <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
                        
                    </div>
                </div>
            </div>
            <br/><br/>
            <div class="row">
            @if($product_banner)
             @foreach($product_banner as $cimage)
             <div class="col-md-6">
            <img src="{{url('brands/'.$cimage->image)}}" alt="" class="mmd-hompage-banner2 w-100 img-fluid bannerimg">
            </div>
            @endforeach
            @endif
        </div>
        </div>

        
        <div class="py-5">
            <h4 class="h2 text-white fw-bold mb-4">Product <span class="text-orange">Categories</span></h4>
            <div class="swiper" id="category-slider">
                <div class="swiper-wrapper">
                @if($cats)
                          @foreach($maincats as $cat)
                          @if($cat->slug!='-')
                    <div class="swiper-slide">
                        <div class="mmd-product-categories">
                            <a href="{{route('category',['category'=>urlencode($cat->slug)])}}" >
                                <img src="{{!empty($cat->catimage) ? url('brands/'.$cat->catimage) :'assets/img/category-placeholder.png'}}" alt="" class="w-100">
                                <h4>{{$cat->name}}</h4>
                            </a>
                        </div>
                    </div>
                    @endif
                    @endforeach
                @endif
                   
                </div>
                <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
            </div>

        </div>
        <div class="row">
                @if($topcats10)
                @foreach($topcats10 as $tcat)
                   @if($tcat->children)
                 <div class="col-md-4 text-center">
                     <h4><span class="text-orange">{{$tcat->name}}</span></h4>
                     <ul id="cul{{$tcat->id}}" class="clist" data-cat={{$tcat->id}}>
                           
                           @foreach($tcat->children as $child)
                           <li>
                               <a href="{{route('category',['category'=>urlencode($child->slug)])}}">{{$child->name}}</a>
                           </li>
                           @endforeach
                           @if(count($tcat->children)>=2)

                        
                           @endif
                     </ul>
                     
                 </div>
                   @endif
                @endforeach
                @endif
                <p class="morecatdiv"><button class="btn bg-orange"><a href="{{url('all-categories')}}">More Categories</a></button></p>
            </div>
               <div class="row">

            
            @if($cat_banner)
             @foreach($cat_banner as $cimage)
             <div class="col-md-4">
            <img src="{{url('brands/'.$cimage->image)}}"  alt="" class="mmd-hompage-banner2 w-100 img-fluid bannerimg catad">
             </div>
            @endforeach
            @endif
        </div>
        <div class="py-5">
            <h4 class="h2 text-white fw-bold border-bottom-2">Products You may <span class="text-orange">Like</span></h4>
            
       <div class="row">
                <div class="col-12">
                    <div class="swiper" id="relslider">
                        <!-- featured -->
                       
                        <div class="swiper-wrapper">
                        @if($randomproducts)
                          @if(isset($randomproducts[0]))
                         @foreach($randomproducts[0] as $prd)
                            <div class="swiper-slide">
                                <a href="{{route("product",['slug'=>$prd->slug])}}">
                                <div class="mmd-product-vertical">
                                    <div class="product-top">
                                        <span class="off-tag">{{$prd->discount}}%</span>
                                        <img src="{{$prd->defaultpic!=null ? url("brands/".$prd->defaultpic) : url('brands/defaultpc.png')}}" alt="{{$prd->title}}" class="img-fluid w-100">
                                    </div>
                                    <div class="product-bottom">
                                        <h4 class="mmd-product-category">{{isset($prd->category) ? $prd->category->name:'No category'}}</h4>
                                        <p class="mmd-product-name">{{ucwords($prd->title)}}</p>
                                        <ul class="mmd-product-rating d-flex list-unstyled pl-0 mb-0">
                                            <li><a href=""><i class="bi-star"></i></a></li>
                                            <li><a href=""><i class="bi-star"></i></a></li>
                                            <li><a href=""><i class="bi-star"></i></a></li>
                                            <li><a href=""><i class="bi-star"></i></a></li>
                                            <li><a href=""><i class="bi-star"></i></a></li>
                                        </ul>
                                        @php
                                        $price=$prd->regular_price-round($prd->regular_price*$prd->discount/100);
                                        @endphp

                                        @if($prd->variant && count($prd->variant)>0)
                                        <p class="mmd-product-price"><span class="old-price">₹{{$prd->regular_price}}</span><span class="new-price">₹{{$price}}</span></p>
<a href="{{route("product",['slug'=>$prd->slug])}}" class="bg-orange btn text-dark seeopt">See Options</a>
                                        @else
                                        <p class="mmd-product-price"><span class="old-price">₹{{$prd->regular_price}}</span><span class="new-price">₹{{$price}}</span></p>
                                        <a data-id={{$prd->id}} onClick="addtocart(this);" class="bg-orange rounded p-2 text-dark"><i class="bi-cart"></i> Add to Cart</a>

                                        @endif
                                    </div>
                                </div>
                            </a>
                            </div>
                        @endforeach
                         @endif
                        @endif
                        </div>
                        <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
                    </div>
                    <!-- 2nd row -->
                    <div class="swiper" id="relslider1">
                        <!-- featured -->
                       
                        <div class="swiper-wrapper">
                        @if($randomproducts)
                          @if(isset($randomproducts[1]))
                         @foreach($randomproducts[1] as $prd)
                            <div class="swiper-slide">
                                <a href="{{route("product",['slug'=>$prd->slug])}}">
                                <div class="mmd-product-vertical">
                                    <div class="product-top">
                                        <span class="off-tag">{{$prd->discount}}%</span>
                                        <img src="{{$prd->defaultpic!=null ? url("brands/".$prd->defaultpic) : url('brands/defaultpc.png')}}" alt="{{$prd->title}}" class="img-fluid w-100">
                                    </div>
                                    <div class="product-bottom">
                                        <h4 class="mmd-product-category">{{isset($prd->category) ? $prd->category->name:'No category'}}</h4>
                                        <p class="mmd-product-name">{{ucwords($prd->title)}}</p>
                                        <ul class="mmd-product-rating d-flex list-unstyled pl-0 mb-0">
                                            <li><a href=""><i class="bi-star"></i></a></li>
                                            <li><a href=""><i class="bi-star"></i></a></li>
                                            <li><a href=""><i class="bi-star"></i></a></li>
                                            <li><a href=""><i class="bi-star"></i></a></li>
                                            <li><a href=""><i class="bi-star"></i></a></li>
                                        </ul>
                                        @php
                                        $price=$prd->regular_price-round($prd->regular_price*$prd->discount/100);
                                        @endphp

                                        @if($prd->variant && count($prd->variant)>0)
                                        <p class="mmd-product-price"><span class="old-price">₹{{$prd->regular_price}}</span><span class="new-price">₹{{$price}}</span></p>
<a href="{{route("product",['slug'=>$prd->slug])}}" class="bg-orange btn text-dark seeopt">See Options</a>
                                    @else
                                        <p class="mmd-product-price"><span class="old-price">₹{{$prd->regular_price}}</span><span class="new-price">₹{{$price}}</span></p>
                                        <a data-id={{$prd->id}} onClick="addtocart(this);" class="bg-orange rounded p-2 text-dark"><i class="bi-cart"></i> Add to Cart</a>
                                        @endif
                                    </div>
                                </div>
                            </a>
                            </div>
                        @endforeach
                         @endif
                        @endif
                        </div>
                        <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>


</div>
 
@endsection

