<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>Surfside Media</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/imgs/theme/LOGO-TL.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    @livewireStyles
</head>

<body>
    <header class="header-area header-style-1 header-height-2">
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">
                        <ul>
                                <li>
                                    <a class="language-dropdown-active" href="#"> <i class="fi-rs-world"></i> VietNamese <i class="fi-rs-angle-small-down"></i></a>
                                    {{-- <ul class="language-dropdown">
                                        <li><a href="#"><img src="{{ asset('assets/imgs/theme/flag-fr.png')}}" alt="">Français</a></li>
                                        <li><a href="#"><img src="{{ asset('assets/imgs/theme/flag-dt.png')}}" alt="">Deutsch</a></li>
                                        <li><a href="#"><img src="{{ asset('assets/imgs/theme/flag-ru.png')}}" alt="">Pусский</a></li>
                                    </ul> --}}
                                </li>                                
                            </ul>
                        </div>
                    </div>
                    <style>
                        .header-top-ptb-1 #news-flash {
                                min-width: 600px;
                                font-size: 14px;
                                line-height: 20px;
                                font-weight: 700;
                            }
                            #news-flash {
                            height: 20px !important;
                        }
                    </style>
                    <div class="col-xl-6 col-lg-4">
                        <div class="text-center">
                            <div id="news-flash" class="d-inline-block">
                                <ul>
                                    <li>Nhận các thiết bị tuyệt vời giảm giá tới 50% <a href="{{ route('shop.index') }}">Xem chi tiết</a></li>
                                    <li>Ưu đãi siêu giá trị - Tiết kiệm nhiều hơn với phiếu giảm giá</li>
                                    <li>Trang sức bạc 25 hợp thời trang, tiết kiệm tới 35% ngay hôm nay <a href="{{ route('shop.index') }}">Mua ngay</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            @auth
                                <ul>
                                    <li><i class="fi-rs-user"></i>{{ Auth::user()->name }}  / 
                                        {{-- <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="{{ route('logout') }}" onclick="envent.preventDefault(); this.closest('form').submit();">Log out</a>
                                        </form> --}}
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                
                                            <a href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('Đăng xuất') }}
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            @else
                            <ul>                                
                                <li><i class="fi-rs-key"></i><a href="{{ route('login') }}">Đăng nhập </a>  / <a href="{{ route('register') }}">Đăng ký</a></li>
                            </ul>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="/"><img src="{{ asset('assets/imgs/theme/LOGO-TL.png')}}" alt="logo"></a>
                    </div>
                    <div class="header-right">
                        @livewire('header-search-component')
                        <div class="header-action-right">
                            <div class="header-action-2">
                                @livewire('wishlist-icon-component')
                                @livewire('cart-icon-component')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="/"><img src="{{ asset('assets/imgs/theme/LOGO-TL.png')}}" alt="logo"></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        @livewire('menu-component')
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                            <nav>
                                <ul>
                                    <li><a class="{{ Request::is('/') ? 'active' : '' }}" href="/">Trang chủ </a></li>
                                    
                                    <li><a class="{{ Request::is('shop') ? 'active' : '' }}" href="{{ route('shop.index') }}">Mua sắm</a></li>
                                    {{-- <li class="position-static"><a href="#">Our Collections <i class="fi-rs-angle-down"></i></a>
                                        <ul class="mega-menu">
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Women's Fashion</a>
                                                <ul>
                                                    <li><a href="product-details.html">Dresses</a></li>
                                                    <li><a href="product-details.html">Blouses & Shirts</a></li>
                                                    <li><a href="product-details.html">Hoodies & Sweatshirts</a></li>
                                                    <li><a href="product-details.html">Wedding Dresses</a></li>
                                                    <li><a href="product-details.html">Prom Dresses</a></li>
                                                    <li><a href="product-details.html">Cosplay Costumes</a></li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Men's Fashion</a>
                                                <ul>
                                                    <li><a href="product-details.html">Jackets</a></li>
                                                    <li><a href="product-details.html">Casual Faux Leather</a></li>
                                                    <li><a href="product-details.html">Genuine Leather</a></li>
                                                    <li><a href="product-details.html">Casual Pants</a></li>
                                                    <li><a href="product-details.html">Sweatpants</a></li>
                                                    <li><a href="product-details.html">Harem Pants</a></li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Technology</a>
                                                <ul>
                                                    <li><a href="product-details.html">Gaming Laptops</a></li>
                                                    <li><a href="product-details.html">Ultraslim Laptops</a></li>
                                                    <li><a href="product-details.html">Tablets</a></li>
                                                    <li><a href="product-details.html">Laptop Accessories</a></li>
                                                    <li><a href="product-details.html">Tablet Accessories</a></li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-34">
                                                <div class="menu-banner-wrap">
                                                    <a href="product-details.html"><img src="{{ asset('assets/imgs/banner/menu-banner.jpg')}}" alt="Surfside Media"></a>
                                                    <div class="menu-banner-content">
                                                        <h4>Hot deals</h4>
                                                        <h3>Don't miss<br> Trending</h3>
                                                        <div class="menu-banner-price">
                                                            <span class="new-price text-success">Save to 50%</span>
                                                        </div>
                                                        <div class="menu-banner-btn">
                                                            <a href="product-details.html">Shop now</a>
                                                        </div>
                                                    </div>
                                                    <div class="menu-banner-discount">
                                                        <h3>
                                                            <span>35%</span>
                                                            off
                                                        </h3>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li> --}}
                                    <li><a class="{{ Request::is('About-us') ? 'active' : '' }}" href="{{ route('AboutUs') }}">Về chúng tôi </a></li>
                                    <li><a class="{{ Request::is('Blog-us') ? 'active' : '' }}" href="{{ route('Blog') }}">Blog </a></li>                                    
                                    <li><a class="{{ Request::is('contact-us') ? 'active' : '' }}" href="{{ route('contactus') }}">Kết nối</a></li>
                                    <li><a href="#">Tài khoản<i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="{{ route('login') }}">Đăng nhập</a></li>                                 
                                        </ul>
                                        @auth
                                        @if(Auth::user()->utype == 'ADM')
                                            <ul class="sub-menu">
                                                <li><a href="{{ route('admin.dashboard') }}">Dữ liệu</a></li>
                                                <li><a href="{{ route('admin.products') }}">Sản phẩm</a></li>
                                                <li><a href="{{ route('admin.categories') }}">Danh mục</a></li>
                                                <li><a href="{{ route('admin.sliders') }}">Slider</a></li>
                                                <li><a href="{{ route('admin.coupons') }}">Mã giảm giá</a></li>
                                                <li><a href="{{ route('admin.attributes') }}">Thuộc tính sản phẩm</a></li>
                                                <li><a href="{{ route('admin.orders') }}">Đơn hàng</a></li>
                                                <li><a href="{{ route('admin.contact') }}">Kết nối</a></li>
                                                {{-- <li><a href="#">Customers</a></li> --}}
                                                <li>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                        
                                                    <a href="route('logout')"
                                                            onclick="event.preventDefault();
                                                                        this.closest('form').submit();">
                                                        {{ __('Log Out') }}
                                                    </a>
                                                </form>
                                            </li>
                                                {{-- <li><li href="#">Logout</li>                                             --}}
                                            </ul>
                                        @elseif (Auth::user()->utype == 'USR')
                                            <ul class="sub-menu">
                                                <li><a href="{{ route('user.dashboard') }}">Trang dữ liệu</a></li>
                                                <li><a href="{{ route('user.orders') }}">Đơn hàng</a></li>
                                            </ul>
                                        @endif
                                        @endauth
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="hotline d-none d-lg-block">
                        <p><i class="fi-rs-smartphone"></i><span>Miễn phí</span> (+84) 5555-555-555 </p>
                    </div>
                    <p class="mobile-promotion">Mừng <span class="text-brand">Ngày của Mẹ</span>. Giảm Giá Lớn Lên Đến 40%</p>
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a href="{{ route('shop.wishlist') }}">
                                    <img class="svgInject" alt="wishlist" src="{{ asset('assets/imgs/theme/icons/icon-heart.svg') }}">
                                    @if (Cart::instance('wishlist')->count() > 0)
                                        <span class="pro-count blue">{{ Cart::instance('wishlist')->count() }}</span>
                                    @endif
                                </a>
                            </div>
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{ route('cart.index') }}">
                                    <img alt="Surfside Media" src="{{ asset('assets/imgs/theme/icons/icon-cart.svg') }}">
                                    @if (Cart::instance('cart')->count() > 0)
                                    <span class="pro-count blue">{{ Cart::instance('cart')->count() }}</span>
                                    @endif
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        @foreach (Cart::instance('cart')->content() as $item)
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="{{ route('product.details',['slug'=>$item->model->slug]) }}"><img alt="{{ $item->model->name }}" src="{{ asset('assets/imgs/products')}}/{{ $item->model->image }}"></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="{{ route('product.details',['slug'=>$item->model->slug]) }}">{{ substr($item->model->name,0,20) }}...</a></h4>
                                                @if ($item->model->sale_price > 0)
                                                <h4><span>{{ $item->qty }} × </span>${{ number_format($item->model->sale_price) }}</h4>
                                                @else
                                                <h4><span>{{ $item->qty }} × </span>${{ number_format($item->model->regular_price) }}</h4>
                                                @endif
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#" onclick="return confirm('Bạn muốn xóa sản phẩm này?')|| event.stopImmediatePropagation()" wire:click.prevent="destroyitem('{{ $item->rowId }}')"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            @php
                                                $total = Cart::instance('cart')->total();
                                            @endphp
                                            <h4>Tổng tiền <span>{{ number_format($total) }} VNĐ</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="{{ route('cart.index') }}" class="outline">Giỏ hàng</a>
                                            <a href="{{ route('checkout.index') }}">Thanh toán</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="header-action-icon-2 d-block d-lg-none">
                                <div class="burger-icon burger-icon-white">
                                    <span class="burger-icon-top"></span>
                                    <span class="burger-icon-mid"></span>
                                    <span class="burger-icon-bottom"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="index.html"><img src="{{ asset('assets/imgs/theme/LOGO-TL.png')}}" alt="logo"></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="#">
                        <input type="text" placeholder="Search for items…">
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    {{-- <div class="main-categori-wrap mobile-header-border">
                        <a class="categori-button-active" href="#">
                            <span class="fi-rs-apps"></span> Danh mục sản phẩm
                        </a>
                        <div class="categori-dropdown-wrap categori-dropdown-active-large">
                            @livewire('menu-mobile-component')
                            <div class="more_categories">Show more...</div>
                        </div>
                    </div> --}}
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="/">Trang chủ</a></li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('shop.index') }}">shop</a></li>
                            @livewire('menu-mobile-component')
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('Blog') }}">Blog</a></li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('AboutUs') }}">Về chúng tôi</a></li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('contactus') }}">Kết nối</a></li>
                            @auth
                            @if (Auth::user()->utype == 'USR')
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Tài khoản</a>
                                <ul class="dropdown">
                                    <li><a href="{{ route('user.dashboard') }}">Trang dữ liệu</a></li>
                                    <li><a href="{{ route('user.orders') }}">Đơn hàng</a></li>
                                </ul>
                            </li>
                            @endif
                            @endauth
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap mobile-header-border">
                            
                    <div class="single-mobile-header-info mt-30">
                        <a href="/contact-us"> Kết nối với chúng tôi </a>
                    </div>
                    @auth
                    <ul>
                        <li><i class="fi-rs-user"></i>{{ Auth::user()->name }}  / 
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Đăng xuất') }}
                                </a>
                            </form>
                        </li>
                    </ul>
                    @else
                    <div class="single-mobile-header-info">
                        <a href="{{ route('login') }}">Đăng nhập </a>                        
                    </div>
                    <div class="single-mobile-header-info">                        
                        <a href="{{ route('register') }}">Đăng ký</a>
                    </div>
                    
                    @endauth
                    <div class="single-mobile-header-info">
                        <a href="#">(+1) 0000-000-000 </a>
                    </div>
                </div>
                <div class="mobile-social-icon">
                    <h5 class="mb-15 text-grey-4">Theo dõi chúng tôi trên</h5>
                    <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-facebook.svg') }}" alt=""></a>
                    <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-twitter.svg') }}" alt=""></a>
                    <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-instagram.svg') }}" alt=""></a>
                    <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-pinterest.svg') }}" alt=""></a>
                    <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-youtube.svg') }}" alt=""></a>
                </div>
            </div>
        </div>
    </div>        

    {{ $slot }}

    <footer class="main">
        <section class="newsletter p-30 text-white wow fadeIn animated">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 mb-md-3 mb-lg-0">
                        <div class="row align-items-center">
                            <div class="col flex-horizontal-center">
                                <img class="icon-email" src="{{ asset('assets/imgs/theme/icons/icon-email.svg') }}" alt="">
                                <h4 class="font-size-20 mb-0 ml-3">Nhận các chương trình khuyến mãi mới nhất từ chúng tôi</h4>
                            </div>
                            <div class="col my-4 my-md-0 des">
                                <h5 class="font-size-15 ml-4 mb-0">...và nhận <strong>phiếu giảm giá $25 cho lần mua sắm đầu tiên.</strong></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <!-- Subscribe Form -->
                        <form class="form-subcriber d-flex wow fadeIn animated">
                            <input type="email" class="form-control bg-white font-small" placeholder="Nhập email của bạn">
                            <button class="btn bg-dark text-white" type="submit">Gửi</button>
                        </form>
                        <!-- End Subscribe Form -->
                    </div>
                </div>
            </div>
        </section>
        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="widget-about font-md mb-md-5 mb-lg-0">
                            <div class="logo logo-width-1 wow fadeIn animated">
                                <a href="/"><img src="{{ asset('assets/imgs/theme/LOGO-TL.png')}}" alt="logo"></a>
                            </div>
                            <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">Contact</h5>
                            <p class="wow fadeIn animated">
                                <strong>Địa chỉ: </strong>999 phố Washington
                            </p>
                            <p class="wow fadeIn animated">
                                <strong>Điện thoại: </strong>+84 999 999 999
                            </p>
                            <p class="wow fadeIn animated">
                                <strong>Email: </strong>contact@SUPERIDOL.com
                            </p>
                            <h5 class="mb-10 mt-30 fw-600 text-grey-4 wow fadeIn animated">Follow Us</h5>
                            <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-facebook.svg') }}" alt=""></a>
                                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-twitter.svg') }}" alt=""></a>
                                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-instagram.svg') }}" alt=""></a>
                                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-pinterest.svg') }}" alt=""></a>
                                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-youtube.svg') }}" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <h5 class="widget-title wow fadeIn animated">Tìm hiểu</h5>
                        <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                            <li><a href="/About-us">Về chúng tôi</a></li>
                            <li><a href="#">Thông tin giao hàng</a></li>
                            <li><a href="#">Chính sách bảo mật</a></li>
                            <li><a href="#">Điều khoản &amp; điều kiện</a></li>
                            <li><a href="/contact-us">Kết nối với chúng tôi</a></li>                            
                        </ul>
                    </div>
                    <div class="col-lg-2  col-md-3">
                        <h5 class="widget-title wow fadeIn animated">Tài khoản</h5>
                        <ul class="footer-list wow fadeIn animated">
                            <li><a href="/user/dashboard">Tài khoản</a></li>
                            <li><a href="/cart">View Cart</a></li>
                            <li><a href="/wishlist">Sản phẩm yêu thích</a></li>
                            <li><a href="/user/dashboard">Theo dõi đơn hàng của tôi</a></li>                            
                            <li><a href="/user/order">Đơn hàng</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 mob-center">
                        <h5 class="widget-title wow fadeIn animated">Phương thức thanh toán</h5>
                        <div class="row">
                            {{-- <div class="col-md-8 col-lg-12">
                                <p class="wow fadeIn animated">From App Store or Google Play</p>
                                <div class="download-app wow fadeIn animated mob-app">
                                    <a href="#" class="hover-up mb-sm-4 mb-lg-0"><img class="active" src="{{ asset('assets/imgs/theme/app-store.jpg')}}" alt=""></a>
                                    <a href="#" class="hover-up"><img src="{{ asset('assets/imgs/theme/google-play.jpg')}}" alt=""></a>
                                </div>
                            </div> --}}
                            <div class="col-md-4 col-lg-12 mt-md-3 mt-lg-0">
                                <p class="mb-20 wow fadeIn animated">Hỗ trợ cổng thanh toán an toàn</p>
                                <img class="wow fadeIn animated" src="{{ asset('assets/imgs/theme/payment-method.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container pb-20 wow fadeIn animated mob-center">
            <div class="row">
                <div class="col-12 mb-20">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-lg-6">
                    <p class="float-md-left font-sm text-muted mb-0">
                        <a href="privacy-policy.html">Chính sách bảo mật</a> | <a href="terms-conditions.html">Điều khoản & điều kiện</a>
                    </p>
                </div>
                <div class="col-lg-6">
                    <p class="text-lg-end text-start font-sm text-muted mb-0">
                        &copy; <strong class="text-brand">SUPERIDOL</strong> Đã lấy
                    </p>
                </div>
            </div>
        </div>
    </footer>    
    <!-- Vendor JS-->
    <script src="{{  asset('assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
    <script src="{{  asset('assets/js/vendor/animsition.min.js')}}"></script>
    <script src="{{  asset('assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
    <script src="{{  asset('assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
    <script src="{{  asset('assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
    <script src="{{  asset('assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{  asset('assets/js/plugins/slick.js')}}"></script>
    <script src="{{  asset('assets/js/plugins/jquery.syotimer.min.js')}}"></script>
    <script src="{{  asset('assets/js/plugins/wow.js')}}"></script>
    <script src="{{  asset('assets/js/plugins/jquery-ui.js')}}"></script>
    <script src="{{  asset('assets/js/plugins/perfect-scrollbar.js')}}"></script>
    <script src="{{  asset('assets/js/plugins/magnific-popup.js')}}"></script>
    <script src="{{  asset('assets/js/plugins/select2.min.js')}}"></script>
    <script src="{{  asset('assets/js/plugins/waypoints.js')}}"></script>
    <script src="{{  asset('assets/js/plugins/counterup.js')}}"></script>
    <script src="{{  asset('assets/js/plugins/jquery.countdown.min.js')}}"></script>
    <script src="{{  asset('assets/js/plugins/images-loaded.js')}}"></script>
    <script src="{{  asset('assets/js/plugins/isotope.js')}}"></script>
    <script src="{{  asset('assets/js/plugins/scrollup.js')}}"></script>
    <script src="{{  asset('assets/js/plugins/jquery.vticker-min.js')}}"></script>
    <script src="{{  asset('assets/js/plugins/jquery.theia.sticky.js')}}"></script>
    <script src="{{  asset('assets/js/plugins/jquery.elevatezoom.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-json/2.6.0/jquery.json.min.js" integrity="sha512-QE2PMnVCunVgNeqNsmX6XX8mhHW+OnEhUhAWxlZT0o6GFBJfGRCfJ/Ut3HGnVKAxt8cArm7sEqhq2QdSF0R7VQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/js/vendor/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Template JS -->
    <script src="{{  asset('assets/js/main.js?v=3.3')}}"></script>
    <script src="{{  asset('assets/js/shop.js?v=3.3')}}"></script>
    @livewireScripts
    @stack('scripts')
    </body>

</html>