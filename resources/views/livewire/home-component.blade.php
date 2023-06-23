<div>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
        .animated {
            font-family: 'Roboto', sans-serif !important;
        }
    </style>
    <main class="main product_data">
        <section class="home-slider position-relative pt-50" wire:ignore>
            <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
                @foreach ($slides as $slide)
                <div class="typeword single-hero-slider single-animation-wrap">
                    <div class="container">
                        <div class="row align-items-center slider-animated-1">
                            <div class="col-lg-5 col-md-6">
                                <div class="hero-slider-content-2">
                                    <h4 class="animated">{{ $slide->top_title }}</h4>
                                    <h2 class="animated fw-900">{{ $slide->title }}</h2>
                                    <h1 class="animated fw-900 text-brand">{{ $slide->sub_title }}</h1>
                                    <p class="animated">{{ $slide->offer }}</p>
                                    <a class="animated btn btn-brush btn-brush-3" href="{{ $slide->link }}"> Mua ngay </a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <div class="single-slider-img single-slider-img-1">
                                    <img class="animated slider-1-1" src="{{ asset('assets/imgs/slider') }}/{{ $slide->image }}" alt="{{ $slide->title }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach         
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </section>
        <section class="featured section-padding position-relative"wire:ignore>
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-1.png" alt="">
                            <h4 class="bg-1">Miễn phí Ship</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-2.png" alt="">
                            <h4 class="bg-3">Đặt hàng trực tuyến</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-3.png" alt="">
                            <h4 class="bg-2">Tích kiệm tiền</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-4.png" alt="">
                            <h4 class="bg-4">Khuyến mãi hot</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-5.png" alt="">
                            <h4 class="bg-5">Bán hàng niềm nở</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-6.png" alt="">
                            <h4 class="bg-6"> Hỗ trợ 24/7</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="product-tabs section-padding position-relative wow fadeIn animated " >
            <div class="bg-square"></div>
            <div class="container">
                <div class="tab-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ Request::is('/') ? 'active' : '' }}" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">Đặc sắc</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#tab-two" type="button" role="tab" aria-controls="tab-two" aria-selected="false">Phổ biến</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-three" data-bs-toggle="tab" data-bs-target="#tab-three" type="button" role="tab" aria-controls="tab-three" aria-selected="false">Đang giảm</button>
                        </li>
                    </ul>
                    <a href="/shop" class="view-more d-none d-md-flex">Xem thêm<i class="fi-rs-angle-double-small-right"></i></a>
                </div>
                <!--End nav-tabs-->
                <div class="tab-content wow fadeIn animated" id="myTabContent" wire:ignore>
                    @php
                        $witems = Cart::instance('wishlist')->content()->pluck('id');
                    @endphp
                    <div class="tab-pane fade show {{ Request::is('/') ? 'active' : '' }}" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row product-grid-4">
                            @foreach ($fproducts as $fproduct)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6" >
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('product.details',['slug'=>$fproduct->slug]) }}">
                                                    <img class="default-img" src="{{ asset('assets/imgs/products')}}/{{ $fproduct->image }}" alt="{{ $fproduct->name }}" width="280px" height="300px">
                                                    <img class="hover-img" src="{{ asset('assets/imgs/products')}}/{{ $fproduct->image2 }}" alt="{{ $fproduct->name }}" width="280px" height="300px">
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick view" class="action-btn hover-up quick_view" id="{{ $fproduct->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal" >
                                                    <i class="fi-rs-search"></i></a>
                                                </a>
                                                @if ($witems->contains($fproduct->id))
                                                    <a aria-label="Remove From Wishlist" class="action-btn hover-up wishlisted" href="#" wire:click.prevent="removeFromWishlist({{ $fproduct->id }})"><i class="fi-rs-heart"></i></a>
                                                @else
                                                    @if ($fproduct->sale_price > 0)
                                                        <a aria-label="Add To Wishlist" class="action-btn hover-up js-addwish-b2" href="#" wire:click.prevent="addToWishList({{ $fproduct->id }},'{{ $fproduct->name }}',{{ $fproduct->sale_price }})"><i class="fi-rs-heart"></i></a>
                                                    @else    
                                                        <a aria-label="Add To Wishlist" class="action-btn hover-up js-addwish-b2" href="#" wire:click.prevent="addToWishList({{ $fproduct->id }},'{{ $fproduct->name }}',{{ $fproduct->regular_price }})"><i class="fi-rs-heart"></i></a>
                                                    @endif
                                                @endif
                                                <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i class="fi-rs-shuffle"></i></a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="hot">Hot</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="/shop">{{ $fproduct->category->name }}</a>
                                            </div>
                                            <h2><a href="{{ route('product.details',['slug'=>$fproduct->slug]) }}">{{ $fproduct->name }}</a></h2>
                                            <input type="text" value="{{ $fproduct->name }}" class="hidden product_name">

                                            <div class="rating-result" title="90%">
                                                <span>
                                                    <span>90%</span>
                                                </span>
                                            </div>
                                            <div class="product-price">
                                                @if ($fproduct->sale_price > 10)
                                                    <span>${{ number_format($fproduct->sale_price) }} </span>
                                                    <span class="old-price">${{ number_format($fproduct->regular_price) }}</span>
                                                @else
                                                    <span>${{ number_format($fproduct->regular_price) }} </span>
                                                @endif
                                            </div>
                                            @if ($fproduct->sale_price > 10)
                                            <div class="product-action-1 show">
                                                <a aria-label="Add To Cart" class="action-btn hover-up js-addwish-b3" href="#" wire:click.prevent="store({{ $fproduct->id}},'{{ $fproduct->name }}',{{ $fproduct->sale_price }} )"><i class="fi-rs-shopping-bag-add"></i></a>
                                            </div>
                                            @else
                                            <div class="product-action-1 show">
                                                <a aria-label="Add To Cart" class="action-btn hover-up js-addwish-b3" href="#" wire:click.prevent="store({{ $fproduct->id}},'{{ $fproduct->name }}',{{ $fproduct->regular_price }} )"><i class="fi-rs-shopping-bag-add"></i></a> 
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab one (Featured)-->
                    <div class="tab-pane fade" id="tab-two" role="tabpanel" aria-labelledby="tab-two" >
                        <div class="row product-grid-4">
                            @foreach ($pproducts as $pproduct)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('product.details',['slug'=>$pproduct->slug]) }}">
                                                    <img class="default-img" src="{{ asset('assets/imgs/products')}}/{{ $pproduct->image }}" alt="{{ $pproduct->name }}" width="280px" height="300px">
                                                    <img class="hover-img" src="{{ asset('assets/imgs/products')}}/{{ $pproduct->image2 }}" alt="{{ $pproduct->name }}" width="280px" height="300px">
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick view" class="action-btn hover-up quick_view" id="{{ $pproduct->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal" >
                                                    <i class="fi-rs-search"></i></a>
                                                </a>
                                                @if ($witems->contains($pproduct->id))
                                                    <a aria-label="Remove From Wishlist" class="action-btn hover-up wishlisted" href="#" wire:click.prevent="removeFromWishlist({{ $pproduct->id }})"><i class="fi-rs-heart"></i></a>
                                                @else
                                                    @if ($pproduct->sale_price > 0)
                                                        <a aria-label="Add To Wishlist" class="action-btn hover-up js-addwish-b2" href="#" wire:click.prevent="addToWishList({{ $pproduct->id }},'{{ $pproduct->name }}',{{ $pproduct->sale_price }})"><i class="fi-rs-heart"></i></a>
                                                    @else    
                                                        <a aria-label="Add To Wishlist" class="action-btn hover-up js-addwish-b2" href="#" wire:click.prevent="addToWishList({{ $pproduct->id }},'{{ $pproduct->name }}',{{ $pproduct->regular_price }})"><i class="fi-rs-heart"></i></a>
                                                    @endif
                                                @endif
                                                <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i class="fi-rs-shuffle"></i></a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="best">Đã bán ({{ $pproduct->countsale }})</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="/shop">{{ $pproduct->category->name }}</a>
                                            </div>
                                            <h2><a href="{{ route('product.details',['slug'=>$pproduct->slug]) }}">{{ $pproduct->name }}</a></h2>
                                            <div class="rating-result" title="90%">
                                                <span>
                                                    <span>90%</span>
                                                </span>
                                            </div>
                                            <div class="product-price">
                                                @if ($pproduct->sale_price > 10)
                                                    <span>${{ number_format($pproduct->sale_price) }} </span>
                                                    <span class="old-price">${{ number_format($pproduct->regular_price) }}</span>
                                                @else
                                                    <span>${{ number_format($pproduct->regular_price) }} </span>
                                                @endif
                                            </div>
                                            @if ($pproduct->sale_price > 10)
                                            <div class="product-action-1 show">
                                                <a aria-label="Add To Cart" class="action-btn hover-up js-addwish-b3" href="#" wire:click.prevent="store({{ $pproduct->id}},'{{ $pproduct->name }}',{{ $pproduct->sale_price }} )"><i class="fi-rs-shopping-bag-add"></i></a>
                                            </div>
                                        @else
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up js-addwish-b3" href="#" wire:click.prevent="store({{ $pproduct->id}},'{{ $pproduct->name }}',{{ $pproduct->regular_price }} )"><i class="fi-rs-shopping-bag-add"></i></a> 
                                        </div>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab two (Popular)-->
                    <div class="tab-pane fade" id="tab-three" role="tabpanel" aria-labelledby="tab-three">
                        <div class="row product-grid-4">
                            @foreach ($nproducts as $nproduct)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('product.details',['slug'=>$nproduct->slug]) }}">
                                                    <img class="default-img" src="{{ asset('assets/imgs/products')}}/{{ $nproduct->image }}" alt="{{ $nproduct->name }}" width="280px" height="300px">
                                                    <img class="hover-img" src="{{ asset('assets/imgs/products')}}/{{ $nproduct->image2 }}" alt="{{ $nproduct->name }}" width="280px" height="300px">
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick view" class="action-btn hover-up quick_view" id="{{ $nproduct->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <i class="fi-rs-search"></i></a>
                                                </a>
                                                @if ($witems->contains($nproduct->id))
                                                    <a aria-label="Remove From Wishlist" class="action-btn hover-up wishlisted" href="#" wire:click.prevent="removeFromWishlist({{ $nproduct->id }})"><i class="fi-rs-heart"></i></a>
                                                @else
                                                    @if ($nproduct->sale_price > 0)
                                                        <a aria-label="Add To Wishlist" class="action-btn hover-up js-addwish-b2" href="#" wire:click.prevent="addToWishList({{ $nproduct->id }},'{{ $nproduct->name }}',{{ $nproduct->sale_price }})"><i class="fi-rs-heart"></i></a>
                                                    @else    
                                                        <a aria-label="Add To Wishlist" class="action-btn hover-up js-addwish-b2" href="#" wire:click.prevent="addToWishList({{ $nproduct->id }},'{{ $nproduct->name }}',{{ $nproduct->regular_price }})"><i class="fi-rs-heart"></i></a>
                                                    @endif
                                                @endif
                                                <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i class="fi-rs-shuffle"></i></a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                {{-- <span class="hot">Hot</span> --}}
                                                @php
                                                    $chia = $nproduct->sale_price / $nproduct->regular_price;
                                                    $nhan = $chia * 100;
                                                    $phantram = 100 - $nhan;
                                                @endphp
                                                <span class="sale"> - {{ number_format($phantram) }}% </span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="/shop">{{ $nproduct->category->name }}</a>
                                            </div>
                                            <h2><a href="{{ route('product.details',['slug'=>$nproduct->slug]) }}">{{ $nproduct->name }}</a></h2>
                                            <div class="rating-result" title="90%">
                                                <span>
                                                    <span>90%</span>
                                                </span>
                                            </div>
                                            <div class="product-price">
                                                @if ($nproduct->sale_price > 10)
                                                    <span>${{ number_format($nproduct->sale_price) }} </span>
                                                    <span class="old-price">${{ number_format($nproduct->regular_price) }}</span>
                                                @else
                                                    <span>${{ number_format($nproduct->regular_price) }} </span>
                                                @endif
                                            </div>
                                            @if ($nproduct->sale_price > 10)
                                            <div class="product-action-1 show">
                                                <a aria-label="Add To Cart" class="action-btn hover-up js-addwish-b3" href="#" wire:click.prevent="store({{ $nproduct->id}},'{{ $nproduct->name }}',{{ $nproduct->sale_price }} )"><i class="fi-rs-shopping-bag-add"></i></a>
                                            </div>
                                        @else
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up js-addwish-b3" href="#" wire:click.prevent="store({{ $nproduct->id}},'{{ $nproduct->name }}',{{ $nproduct->regular_price }} )"><i class="fi-rs-shopping-bag-add"></i></a> 
                                        </div>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab three (New added)-->
                    <div class="tab-pane fade" id="tab-two" role="tabpanel" aria-labelledby="tab-four" >
                    </div>
                </div>
                <!--End tab-content-->
            </div>
        </section>
        <section class="banner-2 section-padding pb-0">
            <div class="container">
                <div class="banner-img banner-big wow fadeIn animated f-none">
                    <img src="assets/imgs/banner/banner-4.png" alt="">
                    <div class="banner-text d-md-block d-none">
                        <h4 class="mb-15 mt-40 text-brand">Repair Services</h4>
                        <h1 class="fw-600 mb-20">We're an Apple <br>Authorised Service Provider</h1>
                        <a href="/shop" class="btn">Learn More <i class="fi-rs-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </section>
        <section class="popular-categories section-padding mt-15 mb-25" wire:ignore>
            <div class="container wow fadeIn animated">
                <h3 class="section-title mb-20"><span>Popular</span> Categories</h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-arrows"></div>
                    <div class="carausel-6-columns" id="carausel-6-columns">
                        @foreach ($pcategories as $pcategory)
                        <div class="card-1">
                            <figure class=" img-hover-scale overflow-hidden">
                                <a href="{{ route('product.category',['slug'=>$pcategory->slug]) }}"><img src="{{ asset('assets/imgs/categories') }}/{{ $pcategory->image }}" alt="{{ $pcategory->name }}"></a>
                            </figure>
                            <h5><a href="{{ route('product.category',['slug'=>$pcategory->slug]) }}">{{ $pcategory->name }}</a></h5>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <section class="banners mb-15">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-img wow fadeIn animated">
                            <img src="assets/imgs/banner/banner-1.png" alt="">
                            <div class="banner-text">
                                <span>Smart Offer</span>
                                <h4>Save 20% on <br>Woman Bag</h4>
                                <a href="/shop">Shop Now <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-img wow fadeIn animated">
                            <img src="assets/imgs/banner/banner-2.png" alt="">
                            <div class="banner-text">
                                <span>Sale off</span>
                                <h4>Great Summer <br>Collection</h4>
                                <a href="/shop">Shop Now <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-md-none d-lg-flex">
                        <div class="banner-img wow fadeIn animated  mb-sm-0">
                            <img src="assets/imgs/banner/banner-3.png" alt="">
                            <div class="banner-text">
                                <span>New Arrivals</span>
                                <h4>Shop Today’s <br>Deals & Offers</h4>
                                <a href="/shop">Shop Now <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-padding" wire:ignore>
            <div class="container wow fadeIn animated">
                <h3 class="section-title mb-20"><span>Hàng</span> mới về</h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-2-arrows"></div>
                    <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-2">
                        @foreach ($lproducts as $lproduct)
                        <div class="product-cart-wrap small hover-up">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ route('product.details',['slug'=>$lproduct->slug]) }}">
                                        <img class="default-img" src="{{ asset('assets/imgs/products')}}/{{ $lproduct->image }}" alt="{{ $lproduct->name }}" width="194px" height="220">
                                        <img class="hover-img" src="{{ asset('assets/imgs/products')}}/{{ $lproduct->image2 }}" alt="{{ $lproduct->name }}">
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Quick view" class="action-btn hover-up quick_view" id="{{ $lproduct->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fi-rs-search"></i></a>
                                    </a>
                                    @if ($witems->contains($lproduct->id))
                                        <a aria-label="Remove From Wishlist" class="action-btn hover-up wishlisted" href="#" wire:click.prevent="removeFromWishlist({{ $lproduct->id }})"><i class="fi-rs-heart"></i></a>
                                    @else
                                        @if ($lproduct->sale_price > 0)
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up js-addwish-b2" href="#" wire:click.prevent="addToWishList({{ $lproduct->id }},'{{ $lproduct->name }}',{{ $lproduct->sale_price }})"><i class="fi-rs-heart"></i></a>
                                        @else    
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up js-addwish-b2" href="#" wire:click.prevent="addToWishList({{ $lproduct->id }},'{{ $lproduct->name }}',{{ $lproduct->regular_price }})"><i class="fi-rs-heart"></i></a>
                                        @endif
                                    @endif
                                    <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i class="fi-rs-shuffle"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @if ($lproduct->countsale > 100 )
                                    <span class="best">Best sell</span>
                                    @elseif ($lproduct->sale_price)
                                        @php
                                        $chia = $lproduct->sale_price / $lproduct->regular_price;
                                        $nhan = $chia * 100;
                                        $phantram = 100 - $nhan;
                                        @endphp
                                        <span class="sale">Sale:{{ number_format($phantram) }}% </span>
                                    @else
                                    <span class="new">New</span>
                                    @endif
                                    {{-- Carbon\Carbon::now() --}}
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <h2><a href="{{ route('product.details',['slug'=>$lproduct->slug]) }}">{{ $lproduct->name }}</a></h2>
                                <div class="rating-result" title="90%">
                                    <span>
                                    </span>
                                </div>
                                <div class="product-price">
                                    @if ($lproduct->sale_price > 10)
                                        <span>${{ number_format($lproduct->sale_price) }} </span>
                                        <span class="old-price">${{ number_format($lproduct->regular_price) }}</span>
                                    @else
                                        <span>${{ number_format($lproduct->regular_price) }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!--End product-cart-wrap-2-->
                    </div>
                </div>
            </div>
        </section>
       
        <section class="section-padding" wire:ignore>
            <div class="container">
                <h3 class="section-title mb-20 wow fadeIn animated"><span>Featured</span> Brands</h3>
                <div class="carausel-6-columns-cover position-relative wow fadeIn animated">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-3-arrows"></div>
                    <div class="carausel-6-columns text-center" id="carausel-6-columns-3">
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-1.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-2.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-3.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-4.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-5.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-6.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-3.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    </main>
</div>

@push('scripts')
    <script>
        $('.js-addwish-b2').on('click', function(e) {
            e.preventDefault();
        });

        $('.js-addwish-b2').each(function() {
            // var nameProduct = $(this).parent().parent().find('.js-name-b2').val();
            var nameProduct = $(this).closest('.product_data').find('.product_name').val();
            $(this).on('click', function() {
                swal(nameProduct, "đã được thêm vào danh sách sản phẩm yêu thích !", "success");
                $(this).addClass('js-addedwish-b2');
                $(this).off('click');
            });
        });
    </script>
    <script>
        $('.js-addwish-b3').on('click', function(e) {
            e.preventDefault();
        });

        $('.js-addwish-b3').each(function() {
            // var nameProduct = $(this).parent().parent().find('.js-name-b2').val();
            var nameProduct = $(this).closest('.product_data').find('.product_name').val();
            $(this).on('click', function() {
                swal(nameProduct, "đã được thêm vào gio hang !", "success");
                $(this).addClass('js-addedwish-b2');
                $(this).off('click');
            });
        });
    </script>
@endpush