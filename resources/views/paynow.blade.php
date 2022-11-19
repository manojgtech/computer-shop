@extends('layouts.home')

@section('content')
<main class="category">
    <div class="category-header  d-flex justify-content-center align-items-center">
        <h3 class="my-4 display-5 fw-bold">Payment Page</h3>
    </div>
    <div class="product-listing">
        <section class="product-listing-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-4" style="display:block;margin: 0 auto;text-align: center;">
                        <button id="rzp-button1" class="btn btn-primary">Pay with Razorpay</button>
                    </div>


</div>
</div>
</section>
</div>
</main>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<form name='razorpayform' action="{{url('paysuccess')}}" method="POST">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" >
    <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
    <input type="hidden" name="amount" value="{{$amount}}">
    @csrf
    <input type="hidden" name="orderid" value="{{$order_id}}">

</form>
<script>
var options = <?php echo $json; ?>;
options.handler = function (response){
    console.log(response);
    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
    document.getElementById('razorpay_signature').value = response.razorpay_signature;
    document.razorpayform.submit();
};
options.theme.image_padding = false;
options.modal = {
    ondismiss: function() {
        console.log("This code runs when the popup is closed");
    },
    escape: true,
    backdropclose: false
};
var rzp = new Razorpay(options);
document.getElementById('rzp-button1').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
</script>

@endsection