@extends('layouts.home')
@section('content')
<main class="category">
    <div class="category-header  d-flex justify-content-center align-items-center">
  
        <h3 class="my-4 display-5 fw-bold">{{$category_name ?? 'Categories'}}</h3>
    </div>
    <div class="product-listing">
        <section class="product-listing-area">
            <div class="container">
                <div class="row">
                      <div class="bredlinks"><nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a class="txtwhite" href="{{url('/')}}"><i class="fa fa-home"></i></a></li>
    
    <li class="breadcrumb-item active" aria-current="page">{{$category_name ?? 'Categories'}}</li>
  </ol>
</nav></div>
                    <div class="col-lg-3">
                        <div class="categories-list">
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
                        <div class="product-filter">
                            <h4>Filter By Price</h4>
                            <div id="price-range"></div>
                            <label for="amount" class="d-flex">Price:<input type="text" id="amount" readonly style="margin:0 0 0 5px;border:0; color:#000;font-size:14px;"></label> 
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <section class="product-section">
                            <div class="product-list-header">
                                <p class="mb-0">Showing <span class="curcount"></span> of <span class="totalcount">30</span> records</p>
                                <div class="dropdown" id="product-sorting">
                                    <button class="btn dropdown-toggle bg-orange" type="button" id="sortingDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Sort By
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="sortingDropdown">
                                        <li><a class="dropdown-item" onclick="sortProducts('l',this);">Latest</a></li>
                                        <li><a class="dropdown-item" onclick="sortProducts('o',this);">Oldest</a></li>
                                        <li><a class="dropdown-item" onclick="sortProducts('pl',this);">Price (Low to high)</a></li>
                                        <li><a class="dropdown-item" onclick="sortProducts('ph',this);">Price (High to low)</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row" id="cproddiv">
                                
                             </div>
                             <div class="spinner-border" role="status" style="display:none;margin: 0 auto;color: red;padding: 54px;">
                            <span class="visually-hidden">Loading...</span>
                            </div>
                            <a data-page="1" onclick="loadProducts();"  id="loadbtn" class="btn bg-orange load-more-btn">Load More</a>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection