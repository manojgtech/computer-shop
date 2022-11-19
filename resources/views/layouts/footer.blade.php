<footer class="mmd-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
                        <h4 class="mmd-footer-heading">Customer Service</h4>
                        <ul class="mmd-footer-links">
                            <li><a href="">Help Center</a></li>
                            <li><a href="">Track an order</a></li>
                            <li><a href="">Return on item</a></li>
                            <li><a href="{{route('page',['slug'=>'privacy-policy'])}}">Return Policy</a></li>
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
                            <input type="text" placeholder="Enter your email address" id="subemail" class="me-2 form-control rounded">

                            <button class="btn bg-dark text-white rounded" id="getnewsbtn">Subscribe</button>

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

        <!-- toast -->
     <div class="toast" id="myToast">
    <div class="toast-header">
        <strong class="me-auto"><i class="bi-gift-fill"></i>Alert</strong>
        
        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
    </div>
    <div class="toast-body">
       
    </div>
</div>
        <!-- toast -->
        <script src="{{asset('js/jquery-3.6.0.min.js')}}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="{{asset('js/bootstrap.bundle.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{asset('js/swiper-bundle.min.js')}}"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script src="{{asset('js/sweetalert.min.js')}}"></script>
        

        
        <!-- <script src="https://rawgit.com/intoro/Lazy_Load_JQuery/master/js/2_2_4_jquery.min.js"></script> -->
        <script>
            
            const productSliders = ()=>{
    let largeSliders = document.querySelectorAll('.product-slider-1')
    let prevArrow = document.querySelectorAll('.prev')
    let nextArrow = document.querySelectorAll('.next')
    largeSliders.forEach((slider, index)=>{
    // this bit checks if there's more than 1 slide, if there's only 1 it won't loop
        let sliderLength = slider.children[0].children.length
        let result = (sliderLength > 0) ? true : false
        const swiper = new Swiper(slider,{
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
            } ); 
    });
}

window.addEventListener('load', productSliders);
 //            new Swiper('#product-slider-1', {
 //                slidesPerView: 4,
 //                spaceBetween: 10,
 //                loop: true,
 //                lazyLoading: true,
 //                keyboard: {
 //                    enabled: true
 //                },
 //                autoplay: {
 //   delay: 5000,
 // },
 //                breakpoints: {
 //                    320: {
 //                        slidesPerView: 2,
 //                        spaceBetween: 20,
 //                    },
 //                    768: {
 //                        slidesPerView: 3,
 //                        spaceBetween: 40,
 //                    },
 //                    1024: {
 //                        slidesPerView: 4,
 //                        spaceBetween: 50,
 //                    },
 //                },
 //            })
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
                observer: true,
            observeParents: true,
            parallax:true,
                nextButton: '#mmd-homepage-slider .swiper-button-next',
                prevButton: '#mmd-homepage-slider .swiper-button-prev', 
                navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    } 
            });

            
            
            new Swiper('#featured-brands-slider', {
                slidesPerView:6,
                spaceBetween: 10,
                lazyLoading: true,
                loop:true,
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
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 6,
                    spaceBetween: 20,
                },
                },
            });
          const swiper1=  new Swiper('#product-gallery', {
                slidesPerView:5,
                spaceBetween: 10,
                lazyLoading: true,
                keyboard: {
                    enabled: true
                },
                hover:false,            
                breakpoints: {
                    320: {
                        slidesPerView: 3,
                        },
                    768: {
                        slidesPerView: 4,
                    },
                    1024: {
                        slidesPerView: 5,
                    },
                },
                navigation: {
                    nextEl: '#product-gallery .swiper-button-next',
                    prevEl: '#product-gallery .swiper-button-prev',
                }
            });
             

             //related product
             new Swiper('#relslider', {
                slidesPerView: 6,
                spaceBetween: 25,
                loop:true,
                lazyLoading: true,
                autoplay: {
                delay: 5000,
                },
                keyboard: {
                    enabled: true
                },              
                nextButton: '#relslider .swiper-button-next',
                prevButton: '#relslider .swiper-button-prev',  
               
            });
            
            // tff
            new Swiper('#relslider1', {
                slidesPerView: 6,
                spaceBetween: 25,
                loop:true,
                lazyLoading: true,
                autoplay: {
                delay: 4000,
                },
                keyboard: {
                    enabled: true
                },              
                nextButton: '#relslider .swiper-button-next',
                prevButton: '#relslider .swiper-button-prev',  
               
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
            var pmin=0;
            var pmax=0;
            var sortby="l";
             var page=1;
            $( "#price-range" ).slider({
                range: true,
                min: 1000,
                max: 100000,
                values: [ 1000, 100000 ],
                slide: function( event, ui ) {
                $( "#amount" ).val( "₹" + ui.values[ 0 ] + " - ₹" + ui.values[ 1 ] );
                pmin=ui.values[ 0 ];
                pmax=ui.values[ 1 ];
                page=parseInt($("#loadbtn").attr('data-page'))-1;
                loadProducts(page);
                }
            });
            $( "#amount" ).val( "₹100 - ₹1000000");
            var sameaddress=false;
            $("document").ready(function(){
                $("#same-address").change(function(){
                  sameaddress=true;
                  if($(this).is(':checked')){
                     $(".shipping-address").css("display",'none');
                  }else{
                    $(".shipping-address").css("display",'block');
                  }
                });
                

                $(".spinner-border").css("display","block");
                var page=$("#upageinfo").attr("data-page");
                if(page=="category"){
                    loadProducts(page);
                }
                // $('img.lazy').lazyload({
                //     effect: "fadeIn"
                // });

                $("#getnewsbtn").click(function(){
                   var email=$("#subemail").val().trim();
                   var emv=validateEmail(email);
                   if(email!="" && emv){
                         var param=$("#upageinfo").attr("data-param");
                $.ajaxSetup({
                 headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
                });
               
                $.ajax({
                type:'POST',
                url:'<?php echo url('subscribeEmail'); ?>',
                data:{email},
                success:function(data) {
                      showToast("Email added to list");
                }

              });
                        
                        //dff
                   }
                });
            });
             
            function sortProducts(sort,th){
                var d=$(th).text();
                $("#sortingDropdown").text("Sort By : "+d);
              sortby=sort;
              page=parseInt($("#loadbtn").attr('data-page'))-1;
              loadProducts(page);
              
            }
            function loadProducts(page=''){
                var param=$("#upageinfo").attr("data-param");
                $.ajaxSetup({
                 headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
                });
               
                if(page==''){
                    page=$("#loadbtn").attr("data-page");
                }
                
                $.ajax({
                type:'POST',
                url:'<?php echo url('categoryProducts'); ?>',
                data:{cat:param,sort:sortby,min:pmin,max:pmax,page },
                success:function(data) {
                    $(".spinner-border").css("display","none");
                    $("#cproddiv").html(data.view);
                    $("#loadbtn").attr("data-page",parseInt(data.page)+1);
                     $(".curcount").text(data.limit);
                     $(".totalcount").text(data.count);
                     if(data.count==0){
                        $("#loadbtn").hide();
                     }
                    if(data.page==data.pagen){
                        $("#loadbtn").hide();
                    }
                }
                });
            }
            var num=1;
            $('.product-qty button:first-child').click(function(){
                 num = $(this).next().val();
                if(num > 1 ){
                    $(this).next().val(num - 1);
                }
            })
            $('.product-qty button:last-child').click(function(){
                var num = $(this).prev().val();
                $(this).prev().val(parseInt(num)+ 1);
            })
            $('#product-gallery .swiper-slide').on('mouseover click', function(){
                $('.product-feature-image').attr('src', $(this).find('img').attr('src'))
                $(this).addClass('swiper-slide-active').siblings().removeClass('swiper-slide-active')
            });

            function addtocart(th){
               var id= $(th).attr("data-id");
               var vid="";
               if($(th).attr("data-id")){
                vid= $(th).attr("data-vid");
               }

                var qw=$(th).attr("data-qty");
                if(typeof qw=='undefined'){
                    qw=1;
                }
                num=qw; 
                $.ajaxSetup({
                    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
                });
               
                $.ajax({
                type:'POST',
                url:'<?php echo route('addtocart'); ?>',
                data:{pid:id,qty:num,varid:vid },
                success:function(data) {
                   showToast("Item added to cart");
                
                   $(".cartq").attr("value",data);
                }
                });
            }
            function updateCart(cid,act){
                var qty=$("#cartqty"+cid).val();
                $.ajaxSetup({
                    headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
                });
                $.ajax({
                type:'POST',
                url:'<?php echo route('updatecart'); ?>',
                data:{pid:cid,qty:qty,sign:act },
                success:function(data) {
                    $(".cartq").attr("value",data);
                   // showToast("Cart updated");
                   var p=parseInt($("#cart"+cid+" .totam").attr("data-val"));
                   console.log(p*data)
                   if(parseInt(data)==0){
                     $("#cart"+cid).remove();
                   }
                   $("#cart"+cid+" .ttam").text(parseInt(data)*p);

                }
                });
            }


            function deleteCart(cid){
                
                $.ajaxSetup({
                    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
                });
               
                $.ajax({
                type:'POST',
                url:'<?php echo route('deletecart'); ?>',
                data:{pid:cid },
                success:function(data) {
                     $(".cartq").text(data);
                   $("#cart"+cid).remove();
                   window.location.reload();
                }
                });
            }

           function showToast(msg){
            // $("#myToast .toast-body").text(msg);
            // $("#myToast").toast('show');
            //window.scrollTo(0,0);
            swal({title:'Alert', text:msg,timer: 2000});
           }

        function validateEmail(email) {
          return email.toLowerCase().match(
              /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            );
        }

        $(".clist").each(function () {
            var $this = $(this);
             var id=$this.attr("data-cat");
             $ul=$("#cul"+id);
                $lis = $ul.children(),
                $a = $("<a  class='text-orange' href='javascript:void(0)' data-cat='"+id+"' type='1'>More &nbsp;<i class='fa fa-arrow-right'</a>")
            if ($lis.length > 4) {
                $ul.after($a);
                $a.click(function () {
            var id=$this.attr("data-cat");
                $ul=$("#cul"+id);
                $lis = $ul.children(),
                $lis.slice(4).toggle();
                if($a.attr('type') =='1'){
                    $a.attr('type',4);
                    $a.html("More &nbsp;<i class='fa fa-arrow-right'></i>");
                }else{
                    $a.attr('type',1);
                    $a.html("Less &nbsp;<i class='fa fa-arrow-right'></i>");
                }
                
                }).click();
            }
            });
        $(".bi-search").click(function(){
          $("#productsearchform").submit();
        });

     </script>
       
            <!-- Cookie Consent by TermsFeed https://www.TermsFeed.com -->
<!-- Cookie Consent by TermsFeed https://www.TermsFeed.com -->
<script type="text/javascript" src="https://www.termsfeed.com/public/cookie-consent/4.0.0/cookie-consent.js" charset="UTF-8"></script>
<script type="text/javascript" charset="UTF-8">
document.addEventListener('DOMContentLoaded', function () {
cookieconsent.run({"notice_banner_type":"simple","consent_type":"express","palette":"light","language":"en","page_load_consent_levels":["strictly-necessary"],"notice_banner_reject_button_hide":false,"preferences_center_close_button_hide":false,"page_refresh_confirmation_buttons":false});
});
</script>






     <script>
      
   function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  }
}

function showPosition(position) {
 latitude = position.coords.latitude;
        longitude = position.coords.longitude;
        accuracy = position.coords.accuracy;
        
        
}

    getLocation();

    var tabChange = function(){
        var tabs = $('#dealtabts > a');
        var active = tabs.filter('.active');
        var next = active.next('a').length ? active.next('a') : tabs.filter(':first-child');
        // Bootsrap tab show, para ativar a tab
        next.tab('show');
    }
    // Tab Cycle function
    var tabCycle = setInterval(tabChange, 30000)
    // Tab click event handler
    $(function(){
        $('#dealtabts a').click(function(e) {
            e.preventDefault();
            // Parar o loop
            clearInterval(tabCycle);
            // mosta o tab clicado, default bootstrap
            $(this).tab('show')
            // Inicia o ciclo outra vez
            setTimeout(function(){

                tabCycle = setInterval(tabChange, 30000)//quando recomeÃ§a assume este timing

            }, 30000);
        });
    });
    
    $("document").ready(function(){
      $("#shmrtxt").click(function(){
         $(".shortpbio").removeClass('d-none');
         $("#shltxt").removeClass("d-none");
         $(".pbio").addClass("d-none");
         $("#shmrtxt").addClass("d-none")
      });
      $("#shltxt").click(function(){
         $(".shortpbio").addClass('d-none');
         $("#shltxt").addClass("d-none");
         $(".pbio").removeClass("d-none");
         $("#shmrtxt").removeClass("d-none")

      });

      $(".colorradio").click(function(){
          var el=$(this);
          console.log(el.attr('data-rprice'))
          var rprice=el.attr('data-rprice');
          var sprice=el.attr('data-sprice');
          var sku=el.attr('data-sku');
          var stock=el.attr('data-stock');
          var id=el.attr('data-varid');
          var disc=(Number(rprice)-Number(sprice))%100/Number(rprice);
          $(".product-price1").text(rprice);
          $(".product-price2").text(sprice);  
           
          if(Number(stock)>0){
            $(".product-stock-status").text("In Stock");
          }else{
            $(".product-stock-status").text("Out of Stock");
          }
          $(".product-price").css("display","inline");
          $(".add-to-cart").attr("data-vid",id).css("display",'inline');
          $(".add-to-cart1").attr("data-vid",id).css("display",'inline');
          $(".prdiscount").css("display","inline").text(Math.floor(disc));
          $(".prsku").css("display","inline").text(sku);
          $(".vprice").css("display","none");

           
      });

      //select vars
      $(".selecvar").change(function(){
         var $this=$(this);
         var id=$this.attr("id");
         var op=$("#"+id+" option:selected");
         console.log(op);
         var rprice=op.attr('data-rprice');
         var vid=op.attr('data-varid');
          var sprice=op.attr('data-sprice');
          var sku=op.attr('data-sku');
          var stock=op.attr('data-stock');
          $(".vprice").css("display","none");
          if(Number(stock)>0){
            $(".product-stock-status").text("In Stock");
          }else{
            $(".product-stock-status").text("Out of Stock");
          }
          var id=op.attr('data-vid');
          $(".product-price1").text(rprice);
          $(".product-price2").text(sprice);
          var disc=(Number(rprice)-Number(sprice))%100/Number(rprice);
          $(".product-price").css("display","inline");
          $(".prdiscount").css("display","inline").text(Math.floor(disc));
          $(".prsku").css("display","inline").text(sku);
          $(".vprice").css("display","none"); 
          $(".add-to-cart").attr("data-vid",vid).css("display",'inline');
          $(".add-to-cart1").attr("data-vid",vid).css("display",'inline');
          
      });
    });

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)

})

    $(document).ready(function(){
        var productRow = $('.relslider .row');
        if(productRow.children().length > 12){
            productRow.css({maxHeight: 740, overflow: 'auto'});
        }
    });

    function incQty(){
        setTimeout(function(){
        var d=document.getElementById("product-quantity");
        var q=d.value;
        document.querySelector(".add-to-cart").setAttribute("data-qty",q);
        },2000);
        
    }

    //ajax address form,addressForm
    $("#addressSaveBtn").click(function(e){
       e.preventDefault();
       const form = document.getElementById('addressForm');
       const fd = new FormData(form); 
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
      });  
    $.ajax({
      url: '{{url('saveAddress')}}',
      data: fd,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function(data){
        var data=JSON.parse(data);
        if(data.status==1){
            var id1=data.address_id1;
            var id2=data.address_id2;
            document.getElementById("address_id1").value=id1;
            document.getElementById("address_id2").value=id2;

        }
      }
    });

    });

    //{{route('checkout')}}

     $("#checkouttopay").click(function(e){
        $("#orderForm").submit();
    //    e.preventDefault();
    //     var id1=document.getElementById("address_id1").value;
    //     var id2=document.getElementById("address_id2").value;
    //     var delnote=document.getElementById("del_note").value; 
    //    $.ajaxSetup({
    //     headers: {
    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //    }
    //   });  
    // $.ajax({
    //   url: '{{route('checkout')}}',
    //   data: {address_id1:id1,address_id2:id2,note:delnote},
    //   processData: false,
    //   contentType: false,
    //   type: 'POST',
    //   success: function(data){
    //     var data=JSON.parse(data);
    //     if(data.status==1){
            

    //     }
    //   }
    // });

    });


    



     </script>







    </body>
</html>
