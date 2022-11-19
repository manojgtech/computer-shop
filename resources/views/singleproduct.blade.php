@extends('layouts.home')
@section('content')
<main class="product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a class="txtwhite" href="{{url('/')}}"><i class="fa fa-home"></i></a></li>
    @if($product->maincategory)
   <li class="breadcrumb-item txtwhite"><a class="txtwhite" href="{{route('category',['category'=>$product->maincategory!=null ? $product->maincategory->slug :'pcs'])}}">{{$product->maincategory->name}}</a></li>
    @endif
    <li class="breadcrumb-item txtwhite"><a class="txtwhite" href="{{route('category',['category'=>$product->category!=null ? $product->category->slug :'pcs'])}}">{{$product->category->name}}</a></li>
    <li class="breadcrumb-item active txtyellow" aria-current="page">{{$product->title}}</li>
  </ol>
</nav>
                    <div class="col-md-5">
                        @if($product->images)
                        @php
                         $images=$product->images->toArray();
                         
                         if(count($images)>0){
                         
                         //unset($images[0]);
                        }
                        @endphp
                        @endif
                        <a data-fslightbox href="{{$product->defaultpic!=null ? url('brands/'.$product->defaultpic) : url('brands/defaultpc.png')}}">
                        <img src="{{$product->defaultpic!=null ? url('brands/'.$product->defaultpic) : url('brands/defaultpc.png')}}" class="img-fluid w-100  rounded product-feature-image" alt="" id="product-feature-image">
                        </a>
                        <div class="swiper" id="product-gallery">
                            <div class="swiper-wrapper">
                                 <div class="swiper-slide">
                                   
                                <img src="{{$product->defaultpic!=null ? url('brands/'.$product->defaultpic) : url('brands/defaultpc.png')}}" class="img-fluid w-100 rounded grouped_elements" alt="" >
                            
                            </div>
                               @php 
                               $imgdata=[]; 
                               @endphp
                               @if(count($images)>0)
                                
                                @foreach($images as $image)
                                @php  
                                 $imgdata[]=isset($image['image']) ? url('brands/'.$image['image']) : url('brands/defaultpc.png');
                                @endphp
                                <div class="swiper-slide">
                                 
                                    <img src="{{isset($image['image']) ? url('brands/'.$image['image']) : url('brands/defaultpc.png')}}" class="img-fluid w-100">
                                  
                                </div>
                                @endforeach
                               @endif 
                               
                            </div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="product-desc">
                            
                            <h4 class="product-title">{{$product->title}}</h4>
                             <p><a class="txtyellow hggh" href="{{$product->brand ? route('brand',['brand'=>$product->brand->name]) : '#'}}">{{$product->brand ? $product->brand->name :''}}</a></p>
                            <div class="price-tag">
                            @if($vars)
                              @php
                                 $prdis="display:none;";
                                 $prdis1="display:inline;";
                              @endphp
                            @else
                              @php
                               $prdis="display:inline;";
                               $prdis1="display:none;";
                               @endphp
                            @endif
                            @if($pranges)
                            <h4 class="product-price vprice" style={{$prdis1}}><span class="text-info product-price1">{{$pranges[0]->minp}}</span> &nbsp;&nbsp;-<span class="product-price2">{{$pranges[0]->maxp}}</span></h4>
                            @endif
                                <h4 class="product-price" style={{$prdis}}><strike class="text-info product-price1">{{$product->regular_price}}</strike> &nbsp;&nbsp;<span class="product-price2">{{$product->sell_price}}</span></h4>
                                 
                                <p class="product-stock-status">{{ ($product->stock>0) ? 'In stock': 'Out of stock'}}</p>
                              
                            </div>
                            @php
                              $d=$product->regular_price-$product->sell_price;

                            @endphp
                            @if($d>=1)
                           <p class="prdiscount" style={{$prdis}}>{{floor((($product->regular_price-$product->sell_price)*100)/$product->regular_price)}}% <span class="text-danger">Off</span></p>
                           @endif
                            <div class="product-qty">
                                <button onclick="incQty();"><i class="bi-dash"></i></button>
                                <input type="number" min=1 value=1 name="product-quantity" id="product-quantity">
                                <button onclick="incQty();"><i class="bi-plus"></i></button>
                            </div>
                            <button style={{$prdis}} class="add-to-cart btn" data-id={{$product->id}}  data-vid="" data-qty="1" onClick="addtocart(this);">
                                Add To Cart
                            </button>
                            <button style={{$prdis}} class="add-to-cart1 btn btn-info"  data-id={{$product->id}}>
                             <a href="{{route('buynow',['id'=>$product->id])}}">
                                Buy Now
                              </a>
                            </button>
                            <ul class="list-unstyled mt-5 wishlist-compare d-none">
                                <li>
                                    <a href="#">
                                        <i class="bi-heart"></i>
                                        Add to Wishlist
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <!-- <i class="bi-arrow-down-up"></i> -->
                                        Compare
                                    </a>
                                </li>
                            </ul>
                            
                            @if($vars)
                            <div class="row">
                                <div class="col-md-4">
                                    <ul class="list-unstyled product-other-list">
                                @foreach($vars as $key =>$var)
                                <li>
                                     @if($var)
                                     @if($key=='Color')
                                     <span>Select color</span><br/>
                                       @foreach($var as $v)
                                       @php
                                        $style="background:".$v['attribute_value'].'; border-color:white;height:25px;width:25px; border-radius: 50%;display: inline-block;border: 2px solid var(--mmd-orange);background-clip: content-box;margin:0 auto;';
                                       @endphp
                                    
                                    <span style="{{$style}}" class="colorradio class{{$v['attribute_name']}}"  value="{{$v['attribute_value']}}"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{$v['attribute_value']}}" data-varid={{$v['id']}} data-rprice="{{$v['regular_price']}}" data-sprice="{{$v['sell_price']}}" data-sku="{{$v['sku']}}" data-stock="{{$v['stock']}}" type="radio" name="{{$v['attribute_value']}}"> &nbsp;&nbsp;</span>
                                    @endforeach
                                    @else
                                    <span>Select {{$key}}</span>
                                      <select class="form-control selecvar" id="{{$key}}-{{$loop->iteration}}" data-varid={{$v['id']}}  name="{{$key}}">
                                        <option>Select Option</option>
                                          @foreach($var as $v)
                                    <option value="{{$v['attribute_value']}}" data-varid={{$v['id']}} data-rprice="{{$v['regular_price']}}" data-sprice="{{$v['sell_price']}}" data-sku="{{$v['sku']}}" data-stock="{{$v['stock']}}">{{$v['attribute_value']}}</option>
                                          @endforeach
                                      </select>
                                    @endif
                                    
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                                </div>
                            </div>
                            @else
                            <ul class="list-unstyled product-other-list">
                                <li class="prsku" style={{$prdis}}>
                                    SKU <span>{{$product->sku}}</span>
                                </li>
                                @endif
@if($product->category)
                                <li>
                                  
                                    Categories <span><a href="{{route('category',['category'=>$product->category!=null ? $product->category->slug :'pcs'])}}" >{{$product->category->name}}</a></span>
                                    
                                </li>
@endif
@if($product->tags)
@php
$ptags=explode(",",$product->tags);
@endphp
                                <li>
                                  
                                    Tags: 
                                    @foreach($ptags as $tag)
                                    <span><a href="{{url("/search/tags/".$tag)}}">{{$tag}}</a></span>
                                    @endforeach
                                </li>
@endif
                            </ul>
                            <div class="shortdesc">
                                @if($product->short_description)
                                 @if(strlen(trim(strip_tags($product->short_description)))>0)
                                <h4 class="text-info">About this item</h4>
                                @php 
                                $ptxt=shortxt($product->short_description);
                                @endphp
                                <div class="pbio">
                                {!! $ptxt !!}
</div>
                                <div class="shortpbio d-none">
                                     {!! $product->short_description !!}
                                </div>
                                <p><a id="shmrtxt" class="txtyellow">Show more..</a></p>
                                <p><a id="shltxt" class="d-none txtyellow">Show less..</a></p>
                                 @endif
                                 @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <nav class="nav nav-pills product-tabs text-center">
                            <a href="#pr-description" class="nav-item nav-link active" data-bs-toggle="pill">Description</a>
                            <a href="#pr-specs" class="nav-item nav-link" data-bs-toggle="pill">Specification</a>
<!-- 
                            <a href="#pr-reviews" class="nav-item nav-link" data-bs-toggle="pill">Reviews</a>
                            <a href="#pr-reviews" class="nav-item nav-link" data-bs-toggle="pill">Reviews</a> -->
                            
                        </nav>
                        <div class="tab-content product-tab-content">
                            <div class="tab-pane fade show active" id="pr-description">
                            <div class="container text-center lead" style="overflow: auto;color:#ffff;">
                                {!! $product->description !!}
                            </div>
                             
                               
                            </div>
                            <div class="tab-pane fade" id="pr-specs">
                          <div class="table-responsive bg-white rounded p-2">
                                    <table class="table">
                                        <tbody>
                                       @if($product->property)
                                       @foreach($product->property as $attr)
                                            <tr>
                                                <td>{{$attr->property_name}}</td>
                                                <td>{{$attr->property_value}}</td>
                                            </tr>
                                       
                                        @endforeach
                                        @endif
                                       
                                        </tbody>
                                    </table>
                               @if($product->pdf)
                               
                          
                                </div>
             <br/>
            <h4 class="related-product-heading">Product <span>Resources</span></h4>
            <div class="table-responsive bg-white rounded p-2">
                              <table class="table">
                                        <tbody>
 <tr>
                                                <td>PDF</td>
                                                <td><a href="{{url('brands/'.$product->pdf)}}">Download File</a></td>
                                            </tr>
                                    </tbody>
                                        </table>
                            @endif
                        </div>
                            </div>
                            <div class="tab-pane fade" id="pr-reviews">
<div class="mx-0 mx-sm-auto" style="color: #0dcaf0!important;">
  <div class="card">
    <div class="card-header bg-primary">
      <h5 class="card-title text-white mt-2" id="exampleModalLabel">Feedback request</h5>
    </div>
    <div class="modal-body">
      <div class="text-center">
        <i class="far fa-file-alt fa-4x mb-3 text-info"></i>
        <p>
          <strong>Your opinion matters</strong>
        </p>
        <p>
          Have some ideas how to improve our product?
          <strong>Give us your feedback.</strong>
        </p>
      </div>
      <hr />
      <form class="px-4" action="">
        <p class="text-center"><strong>Your rating:</strong></p>
        <div class="form-check mb-2">
          <input class="form-check-input" type="radio" name="exampleForm" id="radio3Example1" />
          <label class="form-check-label" for="radio3Example1">
            Very good
          </label>
        </div>
        <div class="form-check mb-2">
          <input class="form-check-input" type="radio" name="exampleForm" id="radio3Example2" />
          <label class="form-check-label" for="radio3Example2">
            Good
          </label>
        </div>
        <div class="form-check mb-2">
          <input class="form-check-input" type="radio" name="exampleForm" id="radio3Example3" />
          <label class="form-check-label" for="radio3Example3">
            Medicore
          </label>
        </div>
        <div class="form-check mb-2">
          <input class="form-check-input" type="radio" name="exampleForm" id="radio3Example4" />
          <label class="form-check-label" for="radio3Example4">
            Bad
          </label>
        </div>
        <div class="form-check mb-2">
          <input class="form-check-input" type="radio" name="exampleForm" id="radio3Example5" />
          <label class="form-check-label" for="radio3Example5">
            Very bad
          </label>
        </div>
        <p class="text-center"><strong>What could we improve?</strong></p>
        <!-- Message input -->
        <div class="form-outline mb-4">
          <textarea class="form-control" id="form4Example3" rows="4"></textarea>
          <label class="form-label" for="form4Example3">Your feedback</label>
        </div>
      </form>
    </div>
    <div class="card-footer text-end">
      <button type="button" class="btn btn-primary">Submit</button>
    </div>
  </div>
</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12">
                    <h4 class="related-product-heading">Product <span>FAQs</span></h4>
                    @if($faqs)
<div class="accordion" id="accordionExample">
    @foreach($faqs as $faq)
   <div class="accordion-item">
    <h2 class="accordion-header" id="heading{{$loop->iteration}}">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$loop->iteration}}" aria-expanded="true" aria-controls="collapse{{$loop->iteration}}" style="background-color: black;color:whitesmoke;font-weight: 600;">
      <p>{!! $faq->question !!}</p>
      </button>
    </h2>
    <div id="collapse{{$loop->iteration}}" class="accordion-collapse collapse" aria-labelledby="heading{{$loop->iteration}}" data-bs-parent="#accordionExample">
      <div class="accordion-body" style="    color: white;
    background: black;">
        <p>{!! $faq->answer !!}</p>
      </div>
    </div>
  </div>
 @endforeach
</div>
@endif
</div>
                </div>
            </div>
            <div class="col-md-2">
                <img src="assets/img/Right-Banner-01.png" class="img-fluid mb-3" alt="">
                <img src="assets/img/Right-Banner-02.png" class="img-fluid" alt="">
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <h4 class="related-product-heading {{$relprods->count()>0 ? '':'d-none'}}">Related <span>Products</span></h4>
                <div class="swiper" id="related-product">
                    <div class="swiper-wrapper">
                        @if($relprods)
                        @foreach($relprods as $prd){
                        <div class="swiper-slide">
                            <div class="mmd-product-vertical">
                                <div class="product-top">
                                     @if($prd->discount)
                                    <span class="off-tag">{{$prd->discount}}%</span>
                                     @endif
                                    <img src="{{$prd->defaultpic!=null ? url('brands/'.$prd->defaultpic) : url('brands/defaultpc.png')}}" alt="{{$prd->title}}" class="img-fluid w-100">
                                </div>
                                <div class="product-bottom">
                                    <h4 class="mmd-product-category">{{$prd->category->name}}</h4>
                                    <p class="mmd-product-name">{{$prd->title}}</p>
                                    <ul class="mmd-product-rating d-flex list-unstyled pl-0 mb-0 d-none">
                                        <li><a href=""><i class="bi-star"></i></a></li>
                                        <li><a href=""><i class="bi-star"></i></a></li>
                                        <li><a href=""><i class="bi-star"></i></a></li>
                                        <li><a href=""><i class="bi-star"></i></a></li>
                                        <li><a href=""><i class="bi-star"></i></a></li>
                                    </ul>
                                    <p class="mmd-product-price"><span class="old-price">₹{{$prd->regular_price}}</span><span class="new-price">₹{{$prd->regular_price-($prd->regular_price*$prd->prd/100)}}</span></p>
                                    <a href="" class="bg-orange rounded p-2 text-dark"><i class="bi-cart"></i> Add to Cart</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                       
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</main>
@php
function shortxt($title){
    if (strlen($title) < 120) {
     return $title;
} else {
   $new = wordwrap($title, 120);
   $new = explode("\n", $new);
   $new = $new[0] . '...';
   return $new;
}
}
@endphp
<script src="{{asset('js/fslightbox.js')}}"></script>
<script type="text/javascript">
    var el=document.getElementById("product-feature-image");
el.addEventListener("click",function(){
var  lightbox = new FsLightbox();
// set up props, like sources, types, events etc.
lightbox.props.sources = @json($imgdata);
lightbox.props.onInit = () => console.log('Lightbox initialized!');

lightbox.open();
});
</script>
@endsection
