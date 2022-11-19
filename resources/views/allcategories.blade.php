@extends('layouts.home')

@section('content')
                        <style>
  .trow{
    display:flex;
    width:100%;
  }
  .twrapper{
    width:500px;
    border:2px solid #4446;
  }
  .tcol{
    padding:1rem;
 /*   width:calc(100%/3);*/
  }
  .tcol:nth-child(2){
    border-left:2px solid #4446;
    border-right:2px solid #4446;
  }

  .theader .tcol{
    background-color: #ff0;
  }
  .col-header{
    background-color: #FFBC11;
    padding: 10px;
    color: #000;
    font-weight: 600;


  }
  .col-header a{
    color: #000;
  }
  .mcol{
     border:1px solid #000;
     margin: 0px;
     padding: 0px;
  }
  .col-secrion{
      color: #000;
      text-align: center;
      padding-top: 10px;
  }
   .col-secrion ul{
    text-align: center;
    margin: 0 auto;
    display: block;
    list-style: disc !important;
  }
  .col-secrion ul li{
    margin: 0; 
    padding: 0;
    text-align: left;
  }
  .col-secrion ul li a{
    color: #000;
  }
  .product-section:before {
    content: '';
    position: absolute;
    width: 1px;
    height: 88.5%;
    top: 70px;
    left: -4px;
    display: none !important;
    background-color: #fff;
}
.uldiv{
        display: flex;
    justify-content: center;
    align-items: center;

}
</style>

<main class="category">
    <div class="category-header  d-flex justify-content-center align-items-center">
        <h3 class="my-4 display-5 fw-bold">All Categories</h3>
    </div>
    <div class="product-listing">
        <section class="product-listing-area">
            <div class="container">
                <div class="row" style="--bs-gutter-x: 0;
    --bs-gutter-y: 0;">
                    <!-- <div class="col-lg-3">
                        <div class="callist1" style="object-fit:contain; width:216px;">
                        @if(isset($brand_banner2))
                         @foreach($brand_banner2 as $bimg)
                            <img src="{{url('brands/'.$bimg->image)}}" class="brandadd1 image"/> 
                         @endforeach   
                        @endif                                   
                            
                        </div>
                       
                    </div> -->
                    <div class="col-lg-12">
                        <section class="product-section">
                           
                            <div class="row text-center bg-white">
                            
                             @if($allcategories)
                                @foreach($allcategories as $cat)

                                   <div class="col-md-3 mcol">
                                       <div class="col-header tcol"><a href="{{route('category',['category'=>$cat->slug])}}">{{$cat->name}}</a></div>
                                       <div class="col-secrion">
                                           @if($cat->children)
                                           <div class="uldiv">
                                           <ul>
                                               @foreach($cat->children as $child)
                                                    
                                                     <li><a href="{{route('category',['category'=>$child->slug])}}">{{$child->name}}</a></li>
                                               @endforeach
                                               </ul>
                                           </div>
                                           @endif
                                       </div>
                                   </div>  
                                @endforeach

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