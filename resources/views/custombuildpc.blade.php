@extends('layouts.home')

@section('content')

<main class="product">
    <style>
        .circle-container {
  position: relative;
  /* 1 */
  width: 20em;
  height: 20em;
  padding: 0;
  border-radius: 50%;
  list-style: none;
  /* 2 */
  box-sizing: content-box;
  /* 3 */
  /*margin: 5em auto 0;*/
  /*border: solid 1px tomato;*/
}
.circle-container > * {
  /* 4 */
  display: block;
  position: absolute;
  top: 50%;
  left: 50%;
  width: 6em;
  height: 6em;
  margin: -3em;
}
.circle-container > :nth-of-type(1) {
  transform: rotate(36deg) translate(10em) rotate(-36deg);
}
.circle-container > :nth-of-type(2) {
  transform: rotate(72deg) translate(10em) rotate(-72deg);
}
.circle-container > :nth-of-type(3) {
  transform: rotate(108deg) translate(10em) rotate(-108deg);
}
.circle-container > :nth-of-type(4) {
  transform: rotate(144deg) translate(10em) rotate(-144deg);
}
.circle-container > :nth-of-type(5) {
  transform: rotate(180deg) translate(10em) rotate(-180deg);
}
.circle-container > :nth-of-type(6) {
  transform: rotate(216deg) translate(10em) rotate(-216deg);
}
.circle-container > :nth-of-type(7) {
  transform: rotate(252deg) translate(10em) rotate(-252deg);
}

.circle-container > :nth-of-type(8) {
  transform: rotate(288deg) translate(10em) rotate(-288deg);
}
.circle-container > :nth-of-type(9) {
  transform: rotate(324deg) translate(10em) rotate(-324deg);
}
.circle-container > :nth-of-type(10) {
  transform: rotate(360deg) translate(10em) rotate(-360deg);
}



.circle-container img {
    display: block;
    width: 60px;
    height: 60px;
    border-radius: 50%;
}

.circle-container li {
    background-image: url(assets/img/mypc/Ellipse.png);
    //background-color: #fff;
    background-position: right bottom, left top;
    background-repeat: no-repeat, repeat;
    background-repeat: no-repeat;
    width: 31%;
    margin: 0 auto;
    display: block;
    object-fit: cover;
    padding: 12px;
    background-size: unset;
}
.circle-container li:last-child img {
  transform: scale(1.25);
}
    </style>
    
    <div class="product-listing">
        <section class="product-listing-area">
            <div class="container">
                <div class="row">
 <div class="col-md-4">
    
    <div class="circlearea">
     <!--    <ul class='circle-container'>
  <li><img src='{{url("assets/img/mypc/Core Components 1.png")}}''></li>
  <li><img src='{{url("assets/img/mypc/Cooling 1.png")}}'></li>
  <li><img src='{{url("assets/img/mypc/image 15.png")}}'></li>
  <li><img src='{{url("assets/img/mypc/image 16.png")}}'></li>
  <li><img src='{{url("assets/img/mypc/image 17.png")}}'></li>
  <li><img src='{{url("assets/img/mypc/image 18.png")}}'></li>
  <li><img src='{{url("assets/img/mypc/Peropherals 1.png")}}'></li>
  <li><img src='{{url("assets/img/mypc/Softwares 1.png")}}'></li>
  <li><img src='{{url("assets/img/mypc/Storage 1.png")}}'></li>
  <li><img src='{{url("assets/img/mypc/Core Components 1.png")}}'></li>
   <li><img src='{{url("assets/img/mypc/Main 1.png")}}'></li> 
</ul> -->

<img src='{{url("assets/img/mypc/Components.png")}}' alt="" usemap="#map" />
<map name="map">
    <area shape="circle" coords="79, 346, 34"  onclick="getapiData(event);" />
    <area shape="circle" coords="179, 420, 37" onclick="getapiData(event);"/>
    <area shape="circle" coords="296, 426, 39" onclick="getapiData(event);"/>
    <area shape="circle" coords="412, 351, 34" onclick="getapiData(event);"/>
    <area shape="circle" coords="448, 225, 40" onclick="getapiData(event);" />
    <area shape="circle" coords="404, 114, 38" onclick="getapiData(event);"/>
    <area shape="circle" coords="297, 37, 35" onclick="getapiData(event);"/>
    <area shape="circle" coords="45, 229, 40" onclick="getapiData(event);"/>
    <area shape="circle" coords="86, 111, 40" onclick="getapiData(event);"/>
    <area shape="circle" coords="176, 37, 38" onclick="getapiData(event);"/>
</map>
    </div>
</div>
<div class="col-md-8">
       <h3 class="text-orange text-left">Build it Yourself</h3>
       <p class="text-left"><span class="text-info">CPU</span>&nbsp;&nbsp;&nbsp; <button class="btn bg-orange">INTEL</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-info">AMD</button></p>
</div>

</div>
                </div>
        </section>
    </div>
</main>
<script>
    function getapiData(e){
        console.log(e);
    }
</script>
@endsection     