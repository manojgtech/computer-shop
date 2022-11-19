@extends('layouts.home')

@section('content')

<main class="category">
    <div class="category-header  d-flex justify-content-center align-items-center">
        <h3 class="my-4 display-5 fw-bold">All Brands</h3>
    </div>
    <div class="product-listing">
        <section class="product-listing-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="callist1" style="object-fit:contain; width:216px;">
                        @if(isset($brand_banner2))
                         @foreach($brand_banner2 as $bimg)
                            <img src="{{url('brands/'.$bimg->image)}}" class="brandadd1 image"/> 
                         @endforeach   
                        @endif                                   
                            
                        </div>
                       
                    </div>
                    <div class="col-lg-9">
                        <section class="product-section">
                            <div class="brandtopadd">
                            @if(isset($brand_banner1))
                         @foreach($brand_banner1 as $bimg)
                            <img src="{{url('brands/'.$bimg->image)}}" class="brandadd2 image"/> 
                         @endforeach   
                        @endif
                            </div>
                            <div class="row brandli">
                             @foreach($allbrands as $brand)
<div class="col-md-4 col-lg-4 col-sm-6">
    
    <a href="{{route('brand',['brand'=>$brand->slug])}}"><img src="{{url('brands/'.$brand->logo)}}" alt="{{$brand->name}}"  class="brnadlogo" /></a>
</div>

                             @endforeach

 
                             </div>
                             
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection