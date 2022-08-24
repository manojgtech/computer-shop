<footer class="mmd-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
                        <h4 class="mmd-footer-heading">Customer Service</h4>
                        <ul class="mmd-footer-links">
                            <li><a href="">Help Center</a></li>
                            <li><a href="">Track an order</a></li>
                            <li><a href="">Return on item</a></li>
                            <li><a href="">Return Policy</a></li>
                            <li><a href="">Privacy & Security</a></li>
                            <li><a href="">Feedback</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
                        <h4 class="mmd-footer-heading">My Account</h4>
                        <ul class="mmd-footer-links">
                            <li><a href="">Help Center</a></li>
                            <li><a href="">Login/Register</a></li>
                            <li><a href="">Wishlist</a></li>
                            <li><a href="">Orders</a></li>
                            <li><a href="">Notification</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-sm-6 mb-4 mb-md-0">
                        <h4 class="mmd-footer-heading">Company</h4>
                        <ul class="mmd-footer-links">
                            <li><a href="">About Newegg</a></li>
                            <li><a href="">Hours & Locations</a></li>
                            <li><a href="">Shop by brand</a></li>
                            <li><a href="">Order History</a></li>
                            <li><a href="">Contact Us</a></li>
                            <li><a href="">Sitemap</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-sm-6 mb-4 mb-md-0">
                        <h4 class="mmd-footer-heading">Connect with us</h4>
                        <ul class="mmd-footer-contact">
                            <li><a href="mailto:{{isset($sections['footer-email']) ? $sections['footer-email']:'' }}"><i class="bi-envelope-paper"></i><span>Email <br> {{isset($sections['footer-email']) ? $sections['footer-email']:'' }}</span></a></li>
                            <li><a href="tel:{{isset($sections['footer-phone']) ? $sections['footer-phone']:'' }}"><i class="bi-telephone-outbound"></i><span>Phone Number <br> {{isset($sections['footer-phone']) ? $sections['footer-phone']:'' }}</span></a></li>
                            <li><a href=""><i class="bi-pin-map"></i>{!! isset($sections['footer-address']) ? $sections['footer-address']:'' !!}</a></li>
                        </ul>
                        <p class="mb-2 mt-3">Get the latest deals and more</p>
                        <form action="#" class="d-flex">
                            <input type="text" placeholder="Enter your email address" class="me-2 form-control rounded">
                            <button class="btn bg-orange rounded">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </footer>
        <div class="mmd-footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-0 text-center text-md-start">Copyright &copy;2022 MakeMyDevice. All right reserved</p>
                    </div>
                    <div class="col-md-6">
                        <ul class="d-flex justify-content-md-end justify-content-center">
                            <li><a href="">Terms & Conditions</a></li>
                            <li><a href="">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{asset('js/jquery-3.6.0.min.js')}}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="{{asset('js/bootstrap.bundle.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{asset('js/swiper-bundle.min.js')}}"></script>
        <script>
            new Swiper('#product-slider-1', {
                slidesPerView: 4,
                spaceBetween: 10,
                loop: true,
                lazyLoading: true,
                keyboard: {
                    enabled: true
                },
                autoplay: {
   delay: 5000,
 },
                breakpoints: {
                    320: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 40,
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 50,
                    },
                },
            })
            new Swiper('#product-slider-2', {
                slidesPerView: 5,
                spaceBetween: 10,
                loop: true,
                lazyLoading: true,
                keyboard: {
                    enabled: true
                },
                autoplay: {
                delay: 5000,
                },
                breakpoints: {
                    320: {
                        slidesPerView: 2
                    },
                    768: {
                        slidesPerView: 3
                    },
                    1024: {
                        slidesPerView: 5
                    },
                },
            })
            new Swiper('#category-slider', {
                slidesPerView: 7,
                spaceBetween: 10,
                loop: true,
                lazyLoading: true,
                keyboard: {
                    enabled: true
                },
                autoplay: {
                delay: 5000,
                },
                breakpoints: {
                    320: {
                        slidesPerView: 3
                    },
                    768: {
                        slidesPerView: 4
                    },
                    1024: {
                        slidesPerView: 7
                    },
                },
            })
            new Swiper('#mmd-homepage-slider', {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                lazyLoading: true,
                keyboard: {
                    enabled: true
                },            
                autoplay: {
                delay: 5000,
                },  
                nextButton: '#mmd-homepage-slider .swiper-button-next',
                prevButton: '#mmd-homepage-slider .swiper-button-prev',  
            })
            
            new Swiper('#featured-brands-slider', {
                slidesPerView:6,
                spaceBetween: 30,
                lazyLoading: true,
                autoplay: {
                delay: 5000,
                },
                keyboard: {
                    enabled: true
                },              
                nextButton: '#featured-brands-slider .swiper-button-next',
                prevButton: '#featured-brands-slider .swiper-button-prev',  
                breakpoints: {
                320: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 50,
                },
                },
            });

            $('.mobile-menu-wrapper .overlay').click(function(res){
                $('.mobile-menu-wrapper').removeClass('shows');
            });
            $('a[burger]').click(function(res){
                $('.mobile-menu-wrapper').addClass('shows');
            })
            $('a[burger]').click(function(res){
                $('.mobile-menu-wrapper').addClass('shows');
            });

            $('.mobile-menu-list li a:first-child').click(function(){
                $('.submenu-wrapper').addClass('shows');
            })
            $('.submenu-wrapper h4 i').click(function(){
                $('.submenu-wrapper').removeClass('shows');
            })
        </script>
    </body>
</html>
