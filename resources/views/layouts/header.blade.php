<style type="text/css">
    .dropdown-menu li {
position: relative;
}
.dropdown-menu .dropdown-submenu {
display: none;
position: absolute;
left: 100%;
top: -7px;
}
.dropdown-menu .dropdown-submenu-left {
right: 100%;
left: auto;
}
.dropdown-menu > li:hover > .dropdown-submenu {
display: block;
}
.dropdown-hover:hover>.dropdown-menu {
display: inline-block;
}
.dropdown-hover>.dropdown-toggle:active {
/*Without this, clicking will make it sticky*/
pointer-events: none;
}
</style>
<header class="desktop d-none d-md-block">
        <nav class="mmd-topbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                    @guest
                        <p>Build your dream PC with BUILD PC. <a href="{{ route('register') }}">Register</a> or <a href="{{ route('login') }}">Login</a> 
                    @else
                    <p>Build your dream PC with BUILD PC. <a href="{{ route('home') }}"> {{ Auth::user()->name }}</a> @guest or <a href="{{ route('login') }}">Login</a> @endguest
                    @endguest
                    </div>
                    <div class="col-md-5 offset-md-1">
                        <div class="row">
                            <div class="col-6 text-start text-md-end">
                                <p class="mt-3 mt-md-0">Email: <a href="mailto:{{isset($sections['header-email']) ? $sections['header-email']:'' }}" class="d-block d-sm-inline-block">{{isset($sections['header-email']) ? $sections['header-email']:'' }}</a></p>
                            </div>
                            <div class="col-6 text-start text-md-end">
                                <p class="mt-3 mt-md-0">Call us now: <a href="tel:{{isset($sections['header-phone']) ? $sections['header-phone']:'' }}" class="d-block d-sm-inline-block">{{isset($sections['header-phone']) ? $sections['header-phone']:'' }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <input type="hidden" id="upageinfo" data-page="{{isset($page) ? $page : ''}}" data-param="{{isset($pcat) ? $pcat :''}}" />
        <meta name="csrf-token" id="csrfmeta" content="{{ csrf_token() }}" />
        <nav class="mmd-navbar navbar navbar-expand-md navbar-dark">
            <!-- Brand -->
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Make<span class="text-orange">My</span>Device
                </a>
                <!-- Toggler/collapsibe Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mmdNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar links -->
                <div class="collapse navbar-collapse" id="mmdNavbar">
                    <ul class="navbar-nav mx-auto mmdNav">
                         <li class="nav-item dropdown dropdown-hover">
          <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button"
            data-mdb-toggle="dropdown" aria-expanded="false">
            Brand Store
          </a>
          <!-- Dropdown menu -->
          <div class="dropdown-menu dropdown-submenu megamenu2" aria-labelledby="navbarDropdown" style="border-top-left-radius: 0;
                            border-top-right-radius: 0;
                          ">
            <div class="container">
              <div class="row my-4">
               @foreach($brandlinks as $child)
                <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                  <div class="list-group list-group-flush">
                    @foreach($child as $cchild)
                    <a href="{{route('brand',['brand'=>$cchild->slug])}}" class="list-group-item list-group-item-action banchor"><img src="{{url("brands/".$cchild->logo)}}" class="aimglogo"></a>
                    @endforeach
                  </div>
                </div>
               @endforeach
               <a href="{{route('allbrands')}}" class="btn btn-parimary text-center">View more</a>
              </div>
            </div>
          </div>
        </li>
        
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('allbrands')}}">Workstation/Server</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('preowned-pc')}}">Pre-owned PC</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('allbrands')}}">Pre-built PC</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            @guest
                            <a class="nav-link" href="{{ route('login') }}">Account/Sigin</a>
                            @else 
                             <a class="nav-link dropdown-toggle" href="{{ route('home') }}" data-bs-toggle="dropdown" id="dropdownMenuButton1" aria-expanded="false">Hello {{Auth::user()->name}}</a>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        </ul>
                             @endguest

                        </li>
                        @guest

                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Orders</a>
                        </li>
                        @endguest
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('cart')}}"><i class="fa cartq" value={{$quantity ? $quantity:''}}>&#xf07a;</i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <nav class="mmd-bottom-nav">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="dropdown">
                            <button class="btn bg-orange dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi-list"></i> Shop by category
                            </button>
                            <ul class="dropdown-menu mmd-categories-dd" aria-labelledby="dropdownMenuButton1">

             @foreach($maincats as $mcat)
                                 @php
                                  $children=$mcat->children;
                                  $children1=$children->chunk(2);
                                  $children!=null ? $children:[];
                                 @endphp                   
                @if(count($children)>0)
                     
                                <li class="nav-item dropdown dropdown-hover">
          <a class="nav-link" href="{{route('category',['category'=>$mcat->slug])}}" id="navbarDropdown" role="button"
            data-mdb-toggle="dropdown" aria-expanded="false">

           <img class="catlogos" src="{{!empty($mcat->logo) ? url('brands/'.$mcat->logo) :url('brands/dfcat.png')}}"> {{$mcat->name}}   <i class="bi-chevron-right" ></i>

          </a>
          <!-- Dropdown menu -->
          <div class="dropdown-menu dropdown-submenu megamenu1 card" aria-labelledby="navbarDropdown" style="border-top-left-radius: 0;
                            border-top-right-radius: 0;
                          ">

            <div class="container card-body">
              <div class="row">

                <div class="col-md-9">

                    <div class="row">

                <h6 class="text-dark text-left cattxt">{{$mcat->name}}</h6>
@if(count($children1)>0)
               @foreach($children1 as $child)
                <div class="col-md-6 col-lg-4 mb-4">
                  <div class="list-group list-group-flush">
                    @foreach($child as $cchild)
                    <a href="{{route('category',['category'=>$cchild->slug])}}" class="list-group-item list-group-item-action">{{$cchild->name}}</a>
                    @endforeach
                  </div>
                </div>
               @endforeach
               @endif
           </div>
           </div>
           <div class="col-md-3">
               <div class="mb-3 mb-lg-0" style="object-fit: contain;">
                   <img src="{{!empty($mcat->banner) ? url('brands/'.$mcat->banner) :url('brands/dfcat.png')}}" class="w-100 catoffer card-image">
               </div>
           </div>
              </div>
            </div>
          </div>
        </li>
        
        @else
        <li><a class="dropdown-item nav-link" href="{{route('category',['category'=>$mcat->slug])}}"><img class="catlogos" src="{{!empty($mcat->logo) ? url('brands/'.$mcat->logo) :url('brands/dfcat.png')}}"> {{$mcat->name}}</i></a></li>
        @endif
        @endforeach
        <li><a class="dropdown-item nav-link" href="{{url('all-categories')}}"><img class="catlogos" src="{{!empty($mcat->logo) ? url('brands/'.$mcat->logo) :url('brands/dfcat.png')}}">All Categories</i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
           
                        <a href="./" class="text-white me-2" style="position:relative;top:6px"><i class="fa fa-home fs-4"></i></a>
                        <form class="form d-inline-block" id="productsearchform" action="{{url('search')}}">
                        <div class="form-group mmd-searchbar">
                            {{csrf_field()}}
                            <input type="text" class="form-control" name="q" placeholder="Search...">
                            <i class="bi-search fs-5"></i>
                        </div>
                        </form>
                    </div>
                    <div class="col-md-3 text-center text-md-end">
                        <button class="btn bg-orange">Build Your PC</button>
                        
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <header class="mobile d-block d-md-none">
        <nav class="navbar navbar-dark mmd-mobile-nav py-2">
            <div class="container-fluid d-flex justify-content-between">
                <div>
                    <a class="text-white me-2" burger><i class="bi-list"></i></a>
                    <a href="{{url('/')}}" logo>MakeMy<span class="text-orange">Device</span></a>
                </div>
                <div>

                    <a href="#" cart><i class="bi-cart"></i></a>
                    <a href="#" user><i class="bi-person"></i></a>
                </div>
            </div>
            <div class="container-fluid">
                <div class="form-group mmd-searchbar">
                    <input type="text" class="form-control form-control-sm" placeholder="Search...">
                    <i class="bi-search py-1 fs-5"></i>
                </div>
            </div>
        </nav>
    </header>
    <div class="mobile-menu-wrapper">
        <span class="overlay"></span>
        <div class="mobile-menu-inner">
            <h4 class="mb-0 p-2 bg-orange text-dark">hello !</h4>
            <ul class="mobile-menu-list">
                <li><a href="javascript:;">All categories <i class="bi-arrow-right float-end"></i> </a></li>
                <li><a href="{{route('allbrands')}}">Brand Store</a></li>
                <li><a href="">Workstation/Server</a></li>
                <li><a href="">Pre-owned PC</a></li>
                <li><a href="">Pre-built PC</a></li>
            </ul>
            <ul class="mobile-menu-list">
                <li><a href="{{route('user-dashboard')}}">Account</a></li>
                <li><a href="">Orders</a></li>
                <li><a href="">Wishlist</a></li>
            </ul>
            <div class="submenu-wrapper">
                <h4 class="mb-0 p-2 bg-orange text-dark"><i class="bi-arrow-left mx-2"></i> All categories</h4>
                <ul class="sub-menus">
                @foreach($maincats as $mcat)
                        <li>
                        <a href="{{route('category',['category'=>$mcat->slug])}}"">{{$mcat->name}}</a>
                        </li>
                @endforeach
                    
                    
                </ul>
            </div>
        </div>
    </div>