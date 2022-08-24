<header class="desktop d-none d-md-block">
        <nav class="mmd-topbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                    @guest
                        <p>Build your dream PC with BUILD PC. <a href="{{ route('register') }}">Register</a> or <a href="{{ route('login') }}">Login</a> 
                    @else
                    <p>Build your dream PC with BUILD PC. <a href="{{ route('register') }}"> {{ Auth::user()->name }}</a> or <a href="{{ route('login') }}">Login</a>


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
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('allbrands')}}">Brand Store</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('allbrands')}}">Workstation/Server</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('allbrands')}}">Pre-owned PC</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('allbrands')}}">Pre-built PC</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user-dashboard') }}">Account/Sigin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user-orders') }}">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart') }}"><i class="fa fa-shoping-cart"></i></a>
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
                                <li><a class="dropdown-item" href="{{route('category',['category'=>$mcat->slug])}}"><i class="bi-laptop" l></i> {{$mcat->name}} <i class="bi-arrow-right-circle" r></i></a></li>
                               @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <i class="bi-home text-white"></i>
                        <div class="form-group mmd-searchbar">
                            <input type="text" class="form-control" placeholder="Search...">
                            <i class="bi-search fs-5"></i>
                        </div>
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