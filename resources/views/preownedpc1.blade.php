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
    <li class="breadcrumb-item"><a class="txtwhite" href="{{url('preowned-pc')}}">Pre-owned PC</a></li>
    <li class="breadcrumb-item active txtyellow" aria-current="page">{{$product->title}}</li>
  </ol>
</nav>
                    <div class="col-md-5">
                        <input type="hidden" id="attribs" data-processor="{{$product->processors}}" data-ram="{{$product->ram}}" data-graphic="{{$product->graphics}}" data-wifi="{{$product->wifi}}" data-hdd="{{$product->hdd}}" data-warranty="{{$product->warranty}}">
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
                            <div class="price-tag">
                            
                            
                                <h4 class="product-price"><strike class="text-info product-price1">{{$product->price}}</strike> &nbsp;&nbsp;<span class="product-price2">{{$product->sell_price}}</span></h4>
                                 
                                <p class="product-stock-status">{{ ($product->stock>0) ? 'In stock': 'Out of stock'}}</p>
                              
                            </div>
                            @php
                              $d=$product->regular_price-$product->sell_price;

                            @endphp
                            @if($d>=1)
                           <p class="prdiscount">{{floor((($product->regular_price-$product->sell_price)*100)/$product->regular_price)}}% <span class="text-danger">Off</span></p>
                           @endif
                            <div class="product-qty">
                                <button  onclick="incQty();"><i class="bi-dash" ></i></button>
                                <input type="number" min=1 value=1 name="product-quantity" id="product-quantity">
                                <button onclick="incQty();"><i class="bi-plus"></i></button>
                            </div>
                            <button  class="add-to-cart btn" data-id={{$product->id}}  data-vid="" data-qty="1" data-type="preowned" onClick="addtocart(this);">
                                Add To Cart
                            </button>
                            <button  class="add-to-cart1 btn btn-info" data-id={{$product->id}}>
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
                            <br/><br/><br/>
                            
                            <div class="row">

                              <form class="form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Choose Processor</label>
                                            <select name="processor" id="processorInput" class="form-control">
                                                @if($processors)
                                                 @foreach($processors as $processor)
                                                <option data-price={{$processor->price}} {{ $product->processors==$processor->id ? 'selected=selected':''}} value={{$processor->id}}>{{$processor->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <!-- end -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Choose Ram</label>
                                            <select name="ram" id="ramInput" class="form-control">
                                                @if($rams)
                                                 @foreach($rams as $ram)
                                                <option data-price={{$ram->price}} {{$product->ram==$ram->id ? 'selected=selected':''}} value={{$ram->id}}>{{$ram->title}}</option>
                                                @endforeach
                                                @endif
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Choose Graphic Card</label>
                                            <select name="graphics" id="graphicsInput" class="form-control">
                                                @if($graphics)
                                                 @foreach($graphics as $graphic)
                                                <option data-price={{$graphic->price}} {{$product->graphics==$graphic->id ? 'selected':''}} value={{$graphic->id}}>{{$graphic->title}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <!-- end -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Choose Hard-disk</label>
                                            <select name="harddisk" id="hddInput" class="form-control">
                                                @if($rams)
                                                 @foreach($hdds as $hdd)
                                                <option data-price={{$hdd->price}} {{$product->hdd==$hdd->id ? 'selected=selected':''}} value={{$hdd->id}}>{{$hdd->title}}</option>

                                                @endforeach
                                                @endif
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>


                         <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Choose Wifi</label>
                                            <select name="wifi" id="wifiInput" class="form-control">
                                                @if($wifis)
                                                 @foreach($wifis as $wifi)
                                                <option data-price={{$wifi->price}} {{$product->wifi==$wifi->id ? 'selected=selected':''}} value={{$wifi->id}}>{{$wifi->title}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <!-- end -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Warranty</label>
                                            <select name="Warranty" id="WarrantyInput" class="form-control">
                                                  @php $war=[1,2,3,4,5];  @endphp
                                                 @foreach($war as $w)
                                                <option data-price={{$product->warranty_price*$w}} {{$product->warranty==$w ? 'selected=selected':''}} value={{$w}}>{{$w}} Year</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                      
                            </form>

                            <div class="text-info" style="margin-top:20px">Final total :<span class="totalprice">{{$product->sell_price}}</span></div> 
                        </div>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <nav class="nav nav-pills product-tabs text-center">
                             <a href="#pr-description" class="nav-item nav-link active" data-bs-toggle="pill">Description</a>
                            <!-- <a href="#pr-specs" class="nav-item nav-link" data-bs-toggle="pill">Specification</a> -->
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
                            <div class="tab-pane fade" id="pr-specs" style="display:none;">
                          <div class="table-responsive bg-white rounded p-2">
                                    <table class="table">
                                        <tbody>
                                      
                                       
                                        </tbody>
                                    </table>
                               
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
        @if($faqs)                
                    <h4 class="related-product-heading">Product <span>FAQs</span></h4>
                    
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

</div>
@endif
                </div>
            </div>
            <div class="col-md-2">
                <img src="assets/img/Right-Banner-01.png" class="img-fluid mb-3" alt="">
                <img src="assets/img/Right-Banner-02.png" class="img-fluid" alt="">
            </div>
        </div>
        
    </div>
</main>

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

var cpu=document.querySelector("#processorInput");
cpu.addEventListener("change",function(){
  var op=cpu.options[cpu.selectedIndex];
  var price=op.getAttribute("data-price");
  var v=op.value;
  var ccpu=document.querySelector("#attribs").getAttribute("data-processor");
  console.log(price)
  var cprice=0;
  for(var i=0;i<cpu.options.length;i++){
    if(cpu.options[i].value==ccpu){
        cprice=(cpu.options[i].getAttribute('data-price'));
    }
    if(cpu.options[i].getAttribute('selected')=='selected'){
        cpu.options[i].removeAttribute('selected');
    }
  }

  
  document.querySelector("#attribs").setAttribute("data-processor",v);
  var total=parseInt(document.querySelector(".totalprice").textContent);
  console.log(cprice,price,total);
  total=total-parseInt(cprice)+parseInt(price);
  document.querySelector(".totalprice").textContent=total;
});
//ram change
var ram=document.querySelector("#ramInput");
ram.addEventListener("change",function(){
  var op=ram.options[ram.selectedIndex];
  var price=op.getAttribute("data-price");
  var v=op.value;
  var ccpu=document.querySelector("#attribs").getAttribute("data-ram");
  console.log(price)
  var cprice=0;
  for(var i=0;i<ram.options.length;i++){
    if(ram.options[i].value==ccpu){
        cprice=(ram.options[i].getAttribute('data-price'));
    }
    if(ram.options[i].getAttribute('selected')=='selected'){
        ram.options[i].removeAttribute('selected');
    }
  }

  
  document.querySelector("#attribs").setAttribute("data-ram",v);
  var total=parseInt(document.querySelector(".totalprice").textContent);
  console.log(cprice,price,total);
  total=total-parseInt(cprice)+parseInt(price);
  document.querySelector(".totalprice").textContent=total;
});

//graphics
var graphics=document.querySelector("#graphicsInput");
graphics.addEventListener("change",function(){
  var op=graphics.options[graphics.selectedIndex];
  var price=op.getAttribute("data-price");
  var v=op.value;
  var ccpu=document.querySelector("#attribs").getAttribute("data-graphic");
  var cprice=0;
  for(var i=0;i<graphics.options.length;i++){
    if(graphics.options[i].value==ccpu){
        cprice=(graphics.options[i].getAttribute('data-price'));
    }
    if(graphics.options[i].getAttribute('selected')=='selected'){
        graphics.options[i].removeAttribute('selected');
    }
  }
 
 console.log(cprice,ccpu,v,price);
  
  document.querySelector("#attribs").setAttribute("data-graphics",v);
  var total=parseInt(document.querySelector(".totalprice").textContent);
  console.log(cprice,price,total);
  total=total-parseInt(cprice)+parseInt(price);
  document.querySelector(".totalprice").textContent=total;
});

//hdd
var hdd=document.querySelector("#hddInput");
hdd.addEventListener("change",function(){
  var op=hdd.options[hdd.selectedIndex];
  var price=op.getAttribute("data-price");
  var v=op.value;
  var ccpu=document.querySelector("#attribs").getAttribute("data-hdd");
  console.log(price)
  var cprice=0;
  for(var i=0;i<hdd.options.length;i++){
    if(hdd.options[i].value==ccpu){
        cprice=(hdd.options[i].getAttribute('data-price'));
    }
    if(hdd.options[i].getAttribute('selected')=='selected'){
        hdd.options[i].removeAttribute('selected');
    }
  }

  
  document.querySelector("#attribs").setAttribute("data-hdd",v);
  var total=parseInt(document.querySelector(".totalprice").textContent);
  console.log(cprice,price,total);
  total=total-parseInt(cprice)+parseInt(price);
  document.querySelector(".totalprice").textContent=total;
});
//wifi
var ram=document.querySelector("#ramInput");
ram.addEventListener("change",function(){
  var op=ram.options[ram.selectedIndex];
  var price=op.getAttribute("data-price");
  var v=op.value;
  var ccpu=document.querySelector("#attribs").getAttribute("data-ram");
  console.log(price)
  var cprice=0;
  for(var i=0;i<ram.options.length;i++){
    if(ram.options[i].value==ccpu){
        cprice=(ram.options[i].getAttribute('data-price'));
    }
    if(ram.options[i].getAttribute('selected')=='selected'){
        ram.options[i].removeAttribute('selected');
    }
  }

  
  document.querySelector("#attribs").setAttribute("data-ram",v);
  var total=parseInt(document.querySelector(".totalprice").textContent);
  console.log(cprice,price,total);
  total=total-parseInt(cprice)+parseInt(price);
  document.querySelector(".totalprice").textContent=total;
});

//warranty 

var ram=document.querySelector("#WarrantyInput");
ram.addEventListener("change",function(){
  var op=ram.options[ram.selectedIndex];
  var price=op.getAttribute("data-price");
  var v=op.value;
  var ccpu=document.querySelector("#attribs").getAttribute("data-warranty");
  console.log(price)
  var cprice=0;
  for(var i=0;i<ram.options.length;i++){
    if(ram.options[i].value==ccpu){
        cprice=(ram.options[i].getAttribute('data-price'));
    }
    if(ram.options[i].getAttribute('selected')=='selected'){
        ram.options[i].removeAttribute('selected');
    }
  }
  document.querySelector("#attribs").setAttribute("data-warranty",v);
  var total=parseInt(document.querySelector(".totalprice").textContent);
  console.log(cprice,price,total);
  total=total-parseInt(cprice)+parseInt(price);
  document.querySelector(".totalprice").textContent=total;
});




</script>
@endsection
