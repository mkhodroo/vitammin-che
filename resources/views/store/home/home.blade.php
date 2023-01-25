@extends('layouts.app')

@section('keywords')
    ویتامین چ , داروخانه آنلاین , لوازم آرایشی و بهداشتی ,  لوازم آرایشی ,  لوازم بهداشتی , مکمل دارویی
@endsection

@section('description')
    ویتامین چ فروشگاه آنلاین مکمل های دارویی ، لوازم آرایشی و بهداشتی
@endsection

@section('content')
    <!-- PAGE -->
    <section class="page-section no-padding slider">
        <div class="container full-width">
        </div>
    </section>
    <!-- /PAGE -->

    <!-- PAGE -->
    <style>
        .thumbnail div.media{
            height: 200px;
        }
        @media only screen and (max-width: 600px) {
            .thumbnail div.media{
                height: 100px;
            }
            .thumbnail div div.buttons{
                width: 100%
            }
        }
    </style>

    <section class="page-section">
        <div class="col-sm-3">

        </div>
        <div class="col-sm-9">
            <div class="swiper newest-products">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                  <!-- Slides -->
                  <div class="text-center swiper-slide" >
                        <img class="width-130" src="{{ url('public/store/assets/img/new-products.png') }}" alt="new-products" style="width: 100%; position: relative; top: -50px">
                  </div>
                    @foreach ($newest_products as $item)
                        <div class="swiper-slide">
                            @include('store.products.single',[
                                'product' => $item
                            ])
                        </div>
                    @endforeach 
                  ...
                </div>
              
                <!-- If we need scrollbar -->
                <div class="swiper-button-next btn btn-default"></div>
                <div class="swiper-button-prev btn btn-default"></div>
                <div class="swiper-scrollbar"></div>
            </div>
    
            <div class="swiper catagories">
                
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="text-center swiper-slide" >
                        <h2 class="width-200 white-color yekan-titr">دسته بندی ها</h2>
                    </div>
                    @foreach ($catagories as $c)
                        <div class="swiper-slide text-center">
                            <a href="{{ route('show-catagory-by-name', ['name' => $c->name]) }}">
                                <img class="width-200" src="{{ env('CATAGORIES_IMAGE_URL') . $c->image }}" alt="capsole" style="width: 100%">
                                <h4 style="font-weight: bold" class="white-color">{{ $c->name }}</h4>
                            </a>
                        </div>
                    @endforeach
                </div>
              
                <!-- If we need scrollbar -->
                <div class="swiper-button-next btn btn-default"></div>
                <div class="swiper-button-prev btn btn-default"></div>
                <div class="swiper-scrollbar"></div>
            </div>
        </div>
    

        <div class="col-sm-12 text-center " style="border: 1px solid gray; border-radius: 10px">
            <h3 style="color: black; font-weight: bold">
                آخرین اخبار حوزه سلامت
            </h3>
            <hr>
            <div class="swiper newest-posts">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    @foreach ($newest_posts as $item)
                        <div class="swiper-slide">
                            @include('store.posts.single',[
                                'item' => $item
                            ])
                        </div>
                    @endforeach 
                  ...
                </div>
              
                <!-- If we need scrollbar -->
                <div class="swiper-button-next btn btn-default"></div>
                <div class="swiper-button-prev btn btn-default"></div>
            </div>
        </div>
        

        
          <script>
            console.log('{{ $newest_posts }}');
            var w = window.innerWidth;
            var spv = 3
            if(w <= 600){
                spv = 1.5;
            }
            if( w >= 600 && w <= 1050){
                spv = 2.5
            }
            if(w >= 1050 && w <= 1200){
                spv = 3.5
            }
            if(w >= 1200){
                spv = 4.5;
            }
            console.log(spv);
            var swiper = new Swiper(".swiper", {
                slidesPerView: spv,
                spaceBetween: 40,
                pagination: {
                el: ".swiper-pagination",
                clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
          </script>
    </section>
    <!-- /PAGE -->
@endsection
        
