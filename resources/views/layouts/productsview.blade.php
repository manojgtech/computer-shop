
    @if(count($products)>0)
    @foreach($products as $product)
    <div class="col-md-3 col-lg-3 col-sm-6">
        <div class="mmd-product-vertical">
            <div class="product-top">
                <span class="off-tag">{{$product->discount}}%</span>
                <a href="{{route("product",['slug'=>$product->slug])}}" ><img lazy src="{{$product->defaultpic!=null ? url("brands/".$product->defaultpic) : url('brands/defaultpc.png')}}" alt="{{$product->title}}" class="img-fluid w-100 lazy"></a>
            </div>
            <div class="product-bottom">
                <h4 class="mmd-product-category">{{ucwords($product->category->name)}}</a></h4>
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


 