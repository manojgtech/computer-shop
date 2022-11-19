@extends('layouts.home')

@section('content')
<div class="container">
 <style>
 .cdiv {
    max-width: 95%;
    position: relative;
    border-radius: 8px;
    margin-top: 40px;
    background-color: #ffff;
    color: #000;
    padding: 20px;
    margin-bottom:40px;
}
 </style>
<main class="cdiv">
   @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last d-none">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Your cart</span>
          <span class="badge bg-primary rounded-pill">{{$quantity ?? 0}}</span>
        </h4>
        <ul class="list-group mb-3">
           @if(count($items)>0)
            @foreach($items as $item)
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">{{$item->name}}</h6>
              <!-- <small class="text-muted">Brief description</small> -->
            </div>
            <span class="text-muted">${{$item->price}}</span>
          </li>
          @endforeach
          @endif
          
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (INR)</span>
            <strong>Rs.{{$total}}</strong>
          </li>
        </ul>

        <form class="card p-2" >
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Promo code">
            <button type="submit" class="btn btn-secondary">Redeem</button>
          </div>
        </form>
      </div>
      <div class="col-md-7 col-lg-8">
        <div class="card">
          <div class="card-body">
           <p><span class="" style="height: 40px; width: 40px;background-color: orange;padding: 10px;">1</span> <span><strong>
           Login</strong></span>
           @guest  
           <span class="loginbtn txtyellow pull-right"><a href="{{route('login',['#'=>'checkout'])}}" class="btn bg-orange">Login</a></span>
            @else
<span class="loginbtn txtyellow pull-right"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
    Change</a></span>
<form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
            @endguest
         </p>
           <p>
             @guest
             <span class="text-orange"><strong>Not Logged in</strong></span>
             @else
            <span><strong class="text-orange">{{ Auth::user()->name }}</strong></span>
             @endguest
           </p>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <p><span class="" style="height: 40px; width: 40px;background-color: orange;padding: 10px;">2</span> <span><strong>
           Delivery Address</strong></span>
         </p>
         <ul class="list-group">
           @if($address)
             @foreach($address as $adrs)

              <li class="list-group-item">
               <input type="radio" value="{{$adrs->id}}" class="address-choose"  name="address"> <strong class="text-orange">{{$adrs->name}} ({{$adrs->phone}})</strong><br/><span>{{$adrs->street}}</span>

              </li>
             @endforeach
             <li class="list-group-item">
              <input type="radio" name="address" value="new"/>New Address
             </li>
           @else
             <li class="list-group-item">
                <strong class="text-orange">No Address</strong>
             </li>

           @endif


         </ul>
          </div>
        </div>
        <br/><br/>
        <!-- ffg -->
        <h4 class="mb-3 billform"><input type="radio"  name="bill_address" value="3">Billing address</h4>
        <form class="needs-validation" id="addressForm" action="{{url('checkoutnow')}}" method="post" novalidate>

          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">Full Name*</label>
              <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Phone Number*</label>
              <input type="tel" class="form-control" id="lastName" name="phonenumber" placeholder="" value="" required>
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>
            <!-- address -->
              <div class="col-sm-6">
              <label for="firstName" class="form-label">Company Name</label>
              <input type="text" class="form-control" id="firstName" name="companyName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">GSTIN Number</label>
              <input type="tel" class="form-control" id="lastName" name="gstnumber" placeholder="" value="" required>
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>
            
<!-- dddd -->
            <div class="col-12">
              <label for="email" class="form-label">Email <span class="text-muted"></span></label>
              <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="col-12">
              <label for="address" class="form-label">Street Address</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="col-12">
              <label for="address2" class="form-label">Landmark </label>
              <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment or suite">
            </div>
			      <div class="col-12">
              <label for="address2" class="form-label">City <span class="text-muted"></span></label>
              <input type="text" class="form-control" id="address2" name="city" placeholder="City">
            </div>

            <div class="col-md-5">
              <label for="country" class="form-label">Country</label>
              <select class="form-select" id="country" name="country" required>
                @php
                $states=$indianStates = [
'AP' => 'Andhra Pradesh',
'AR' => 'Arunachal Pradesh',
'AS' => 'Assam',
'BR' => 'Bihar',
'CT' => 'Chhattisgarh',
'GA' => 'Goa',
'GJ' => 'Gujarat',
'HR' => 'Haryana',
'HP' => 'Himachal Pradesh',
'JK' => 'Jammu and Kashmir',
'JH' => 'Jharkhand',
'KA' => 'Karnataka',
'KL' => 'Kerala',
'MP' => 'Madhya Pradesh',
'MH' => 'Maharashtra',
'MN' => 'Manipur',
'ML' => 'Meghalaya',
'MZ' => 'Mizoram',
'NL' => 'Nagaland',
'OR' => 'Odisha',
'PB' => 'Punjab',
'RJ' => 'Rajasthan',
'SK' => 'Sikkim',
'TN' => 'Tamil Nadu',
'TG' => 'Telangana',
'TR' => 'Tripura',
'UP' => 'Uttar Pradesh',
'UT' => 'Uttarakhand',
'WB' => 'West Bengal',
'AN' => 'Andaman and Nicobar Islands',
'CH' => 'Chandigarh',
'DN' => 'Dadra and Nagar Haveli',
'DD' => 'Daman and Diu',
'LD' => 'Lakshadweep',
'DL' => 'National Capital Territory of Delhi',
'PY' => 'Puducherry'];
@endphp
                <option value="">Choose...</option>
                <option value="india" checked>India</option>
              </select>
              <div class="invalid-feedback">
                Please select a valid country.
              </div>
            </div>
            {{ csrf_field() }}
            <div class="col-md-4">
              <label for="state"  class="form-label">State</label>
              <select class="form-select" name="state" id="state" required>
                <option value="">Choose...</option>
               @foreach($states as $state)
               <option value="{{$state}}">{{$state}}</option>
               @endforeach
              </select>
              <div class="invalid-feedback">
                Please provide a valid state.
              </div>
            </div>

            <div class="col-md-3">
              <label for="zip" class="form-label">Zip</label>
              <input type="text" class="form-control" id="zip" name="zip" placeholder="zipcode" required inputmode="numeric" minlength="6" maxlength="6">
              <div class="invalid-feedback">
                Zip code required.
              </div>
            </div>
          </div>
          @guest
          <input type="hidden" name="user_id" value="">
          @else
          <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
          @endguest
          <hr class="my-4">
          <div class="form-check">
            <input type="checkbox" class="form-check-input"  value="1" name="sameaddress" checked id="same-address">
            <label class="form-check-label" for="same-address">Shipping address is the same as my billing address</label>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" value="1" name="sameaddress" checked id="save-info">
            <label class="form-check-label" for="save-info">Save this information for next time</label>
          </div>
          <div class="shipping-address" style="display:none;">
            <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">Full Name*</label>
              <input type="text" class="form-control" id="sfirstName" name="sfirstName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Phone Number*</label>
              <input type="tel" class="form-control" id="slastName" name="sphonenumber" placeholder="" value="" required>
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>
            <!-- address -->
              <div class="col-sm-6">
              <label for="firstName" class="form-label">Company Name</label>
              <input type="text" class="form-control" id="sfirstName" name="scompanyName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">GSTIN Number</label>
              <input type="tel" class="form-control" id="slastName" name="sgstnumber" placeholder="" value="" required>
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>
            
<!-- dddd -->
            <div class="col-12">
              <label for="email" class="form-label">Email <span class="text-muted"></span></label>
              <input type="email" class="form-control" id="semail" name="semail" placeholder="you@example.com">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="col-12">
              <label for="address" class="form-label">Street Address</label>
              <input type="text" class="form-control" id="saddress" name="saddress" placeholder="1234 Main St" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="col-12">
              <label for="address2" class="form-label">Landmark </label>
              <input type="text" class="form-control" id="saddress2" name="saddress2" placeholder="Apartment or suite">
            </div>
      <div class="col-12">
              <label for="address2" class="form-label">City <span class="text-muted"></span></label>
              <input type="text" class="form-control" id="saddress2" name="scity" placeholder="City">
            </div>

            <div class="col-md-5">
              <label for="country" class="form-label">Country</label>
              <select class="form-select" id="scountry" name="scountry" required>
                @php
                $states=$indianStates = [
'AP' => 'Andhra Pradesh',
'AR' => 'Arunachal Pradesh',
'AS' => 'Assam',
'BR' => 'Bihar',
'CT' => 'Chhattisgarh',
'GA' => 'Goa',
'GJ' => 'Gujarat',
'HR' => 'Haryana',
'HP' => 'Himachal Pradesh',
'JK' => 'Jammu and Kashmir',
'JH' => 'Jharkhand',
'KA' => 'Karnataka',
'KL' => 'Kerala',
'MP' => 'Madhya Pradesh',
'MH' => 'Maharashtra',
'MN' => 'Manipur',
'ML' => 'Meghalaya',
'MZ' => 'Mizoram',
'NL' => 'Nagaland',
'OR' => 'Odisha',
'PB' => 'Punjab',
'RJ' => 'Rajasthan',
'SK' => 'Sikkim',
'TN' => 'Tamil Nadu',
'TG' => 'Telangana',
'TR' => 'Tripura',
'UP' => 'Uttar Pradesh',
'UT' => 'Uttarakhand',
'WB' => 'West Bengal',
'AN' => 'Andaman and Nicobar Islands',
'CH' => 'Chandigarh',
'DN' => 'Dadra and Nagar Haveli',
'DD' => 'Daman and Diu',
'LD' => 'Lakshadweep',
'DL' => 'National Capital Territory of Delhi',
'PY' => 'Puducherry'];
@endphp
                <option value="">Choose...</option>
                <option value="india" checked>India</option>
              </select>
              <div class="invalid-feedback">
                Please select a valid country.
              </div>
            </div>
            {{ csrf_field() }}
            <div class="col-md-4">
              <label for="state"  class="form-label">State</label>
              <select class="form-select" name="sstate" id="state" required>
                <option value="">Choose...</option>
               @foreach($states as $state)
               <option value="{{$state}}">{{$state}}</option>
               @endforeach
              </select>
              <div class="invalid-feedback">
                Please provide a valid state.
              </div>
            </div>

            <div class="col-md-3">
              <label for="zip" class="form-label">Zip</label>
              <input type="text" class="form-control" id="zip" name="szip" placeholder="zipcode" required inputmode="numeric" minlength="6" maxlength="6">
              <div class="invalid-feedback">
                Zip code required.
              </div>
            </div>
          </div>
          </div>
          <br/>
          <div style="height:40px;"></div>
          <div class="text-center">
           <button class="btn bg-orange" id="addressSaveBtn">Save & Deliver Here</button>
           <button class="btn btn-info" type="button"><a href="#">Cancel</a></button>
          </div>
          
        </form>

      <form id="orderForm" action="{{url('checkoutnow')}}" method="post">
         {{ csrf_field() }}
        <div class="form-group">
          <input type="hidden" name="address_id1" id="address_id1" value="">
           <input type="hidden" name="address_id2" id="address_id2" value="">
          @guest
          <input type="hidden" name="user_id" value="">
          @else
          <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
          @endguest
            <h5>Delivery Instruction</h5>
            <textarea class="form-control" id="del_note" name="delivery_inst"></textarea>
          </div>
          <div style="height:40px;"></div>
          <div class="text-center">
          </div>
      </form>
      <!-- cart data -->

      <div class="card">
        <div class="card-header bg-orange">
          3 &nbsp;&nbsp;Order Summary
        </div>
        <div class="card-body">
          @foreach($items as $item)
        @if($loop->iteration==1)
         <div class="card rounded-3 mb-4">
<div class="row d-flex justify-content-between align-items-center" style="padding: 15px;">
              <div class="col-md-6 col-lg-6 col-xl-6">
                 <strong>Product</strong>
              </div>

              <div class="col-md-2 col-lg-2 col-xl-2">
                    <strong>Price</strong>
              </div>
              <div class="col-md-2 col-lg-2 col-xl-2">
                 <strong>Quantity</strong>
              </div>
              <div class="col-md-2 col-lg-2 col-xl-2">
                 <strong>Subtotal</strong>
              </div>
         </div>
        @endif
        <div class="card rounded-3 mb-4" id="cart{{$item->id}}">

          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2">
                <img
                  src="{{$item->associatedModel->defaultpic ? url('brands/'.$item->associatedModel->defaultpic) : url('brands/defaultpc.png')}}"
                  class="img-fluid rounded-3" alt="{{$item->name}}">
              </div>
              <div class="col-md-4 col-lg-4 col-xl-4">
                <p class="fw-normal mb-2">{{$item->name}}</p>
                <p class="d-none"><span class="text-muted">Size: </span>M <span class="text-muted">Color: </span>Grey</p>
               <p class="cartbtns"> <a class=" btn  btn-danger" onclick="addWishlist({{$item->id}});">Move to wishlist</a>
                <a class="btn  btn-danger" onclick="deleteCart({{$item->id}});"><i class="fa fa-times"></i>&nbsp;Remove</a></p>
              
              </div>

              <div class="col-md-2 col-lg-2 col-xl-2">
                <h5 class="mb-0 ttam">₹{{$item->price}} </h5>
              </div>
              <div class="col-md-2 col-lg-2 col-xl-2 d-flex">
                <button class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepDown();updateCart({{$item->id}},2);">
                  <i class="fa fa-minus"></i>
                </button>

                <input id="cartqty{{$item->id}}" readonly min="0" name="quantity" data-id="{{$item->id}}" onchange="updateCart();" value="{{$item->quantity}}" type="number"
                  class="form-control form-control-sm" />

                <button class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepUp();updateCart({{$item->id}},1);">
                  <i class="fa fa-plus"></i>
                </button>
              </div>

              <div class="col-md-2 col-lg-2 col-xl-2  totam" data-val="{{$item->price}}">
                <h5 class="mb-0 ttam">₹{{$item->price*$item->quantity}} </h5>
              </div>
              
             
            </div>
          </div>
        </div>
        @endforeach
        </div>
      </div>
    </div>

    <!-- end card -->
  </div>
  <div class="col-md-4">
     
        <div class="card">
          <div class="card-header">
            <h4 class="text-center card-title txtyellow">Summary</h4>
          </div>
           <div class="card-body"><p>Items({{$quantity}}) <span class="txtyellow pull-right">₹{{$amount}}</span></p></div>
          <div class="card-body p-4 d-flex flex-row">

            
            <div class="form-outline flex-fill">
              <label class="form-label" for="form1"><strong>Apply Promo Code</strong></label>
              <br/>
              <input type="text" id="form1" class="form-control form-control-lg" />
              
            </div>
            <button type="button" style="height: 47px;
    margin-left: 4px;margin-top: 30px;" class="btn btn-warning btn-block btn-lg">Apply</button>
            

          </div>
          <div class="card-body">
            <button type="button" id="checkouttopay" class="btn btn-warning btn-block btn-lg">Proceed to Pay</button>
          </div>
        </div>

       
     
  </div>
  </main>
</div>
<script type="text/javascript">
  window.addEventListener('load', () => {
    document.addEventListener("input",function(e){
       var el=e.target;
       
       if(el.name=="address"){
          document.querySelector(".billform").style.display="none"
          document.querySelector(".needs-validation").style.display="none"
       }else if(el.value=="new"){

           document.querySelector(".billform").style.display="block"
          document.querySelector(".needs-validation").style.display="block"
       }
          
    });
    //address choose
      const adrdos=document.querySelectorAll('input[type="radio"][name="address"]');
        adrdos.forEach(function(radio){
       radio.addEventListener('change', changeHandler);
    });

      function changeHandler(event) {
        var v=this.value;
        console.log(v);
        if(v=='new'){
           document.querySelector(".billform").style.display="block"
          document.querySelector(".needs-validation").style.display="block"
        }else{
          document.getElementById("address_id1").value=v;
          document.querySelector(".billform").style.display="none"
          document.querySelector(".needs-validation").style.display="none"
          document.getElementById("orderForm").style.display="block"
        }
        
      }
     
     });
</script>

  @endsection