<div>
    <style>
        nav svg{
            height: 20px;
        }
        nav .hidden{
            display: block;
        }
        .wishlisted{
            background-color: #f15412 !important;
            border: 1px solid transparent !important;
        }
        .wishlisted i{
            color: #fff !important;
        }
    </style>

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>
                    <span></span> Cửa hàng
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50 product_data">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p> We found <strong class="text-brand">{{ $products->total() }}</strong> items for you!</p>
                            </div>
                            <div class="sort-by-product-area">
                                <div class="sort-by-cover mr-10">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps"></i>Show:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span> {{ $pageSize }} <i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a class="{{ $pageSize==12 ? 'active' : '' }}" href="#" wire:click.prevent="changePageSize(12)">12</a></li>
                                            <li><a class="{{ $pageSize==24 ? 'active' : '' }}" href="#" wire:click.prevent="changePageSize(24)">24</a></li>
                                            <li><a class="{{ $pageSize==36 ? 'active' : '' }}" href="#" wire:click.prevent="changePageSize(36)">36</a></li>
                                            <li><a class="{{ $pageSize==48 ? 'active' : '' }}" href="#" wire:click.prevent="changePageSize(48)">48</a></li>
                                            <li><a class="{{ $pageSize > 48 ? 'active' : '' }}" href="#" wire:click.prevent="AllPageSize">All</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="sort-by-cover">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps-sort"></i>Sắp xếp theo:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span> {{$orderBy}} <i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            {{-- <li><a class="active" href="#">Featured</a></li> --}}
                                            <li><a class="{{ $orderBy=='Mặc định' ? 'active' : '' }}" href="#" wire:click.prevent="changeOrderBy('Mặc định')">Mặc định</a></li>
                                            <li><a class="{{ $orderBy=='Thấp đến cao' ? 'active' : '' }}" href="#" wire:click.prevent="changeOrderBy('Thấp đến cao')">Giá: Thấp đến cao</a></li>
                                            <li><a class="{{ $orderBy=='Cao đến thấp' ? 'active' : '' }}" href="#" wire:click.prevent="changeOrderBy('Cao đến thấp')">Giá: Cao đến thấp</a></li>
                                            <li><a class="{{ $orderBy=='Mới nhất' ? 'active' : '' }}" href="#" wire:click.prevent="changeOrderBy('Mới nhất')">Sản phẩm mới nhất</a></li>
                                            <li><a href="#">Theo đánh giá</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row product-grid-3">
                            @if (Session::has('success_message'))
                                <div class="alert alert-success">
                                    <strong>Success | {{ Session::get('success_message') }}</strong>
                                </div>
                            @endif
                            @php
                                $witems = Cart::instance('wishlist')->content()->pluck('id');
                            @endphp
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-4 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ route('product.details',['slug'=>$product->slug]) }}">
                                                <img class="default-img" src="{{ asset('assets/imgs/products')}}/{{ $product->image }}" alt="{{ $product->name }}">
                                                <img class="hover-img" src="{{ asset('assets/imgs/products')}}/{{ $product->image2 }}" alt="{{ $product->name }}">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up quick_view" id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id_product="{{ $product->id}}" >
                                                <i class="fi-rs-search"></i></a>
                                            </a>
                                            {{--  onclick="deleteConfirmationn({{ $product->id }})" --}}
                                            {{-- <a aria-label="Add To Wishlist" class="action-btn hover-up" href="wishlist.php"><i class="fi-rs-heart"></i></a> --}}
                                            @if ($witems->contains($product->id))
                                                <a aria-label="Remove From Wishlist" class="action-btn hover-up wishlisted" href="#" wire:click.prevent="removeFromWishlist({{ $product->id }})"><i class="fi-rs-heart"></i></a>
                                            @else
                                                @if ($product->sale_price > 0)
                                                    <a aria-label="Add To Wishlist" class="action-btn hover-up js-addwish-b2" href="#" wire:click.prevent="addToWishList({{ $product->id }},'{{ $product->name }}',{{ $product->sale_price }})"><i class="fi-rs-heart"></i></a>
                                                @else    
                                                    <a aria-label="Add To Wishlist" class="action-btn hover-up js-addwish-b2" href="#" wire:click.prevent="addToWishList({{ $product->id }},'{{ $product->name }}',{{ $product->regular_price }})"><i class="fi-rs-heart"></i></a>
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
                                            <a href="shop.html">Music</a>
                                        </div>
                                        <h2><a href="{{ route('product.details',['slug'=>$product->slug]) }}">{{ $product->name }}</a></h2>
                                        <input type="text" value="{{ $product->name }}" class="hidden product_name">
                                        <div class="rating-result" title="90%">
                                            <span>
                                                <span>90%</span>
                                            </span>
                                        </div>
                                        <div class="product-price">
                                            @if ($product->sale_price > 10)
                                                <span>${{ number_format($product->sale_price) }} </span>
                                                <span class="old-price">${{ $product->regular_price }}</span>
                                            @else
                                                <span>${{ number_format($product->regular_price) }} </span>
                                            @endif
                                        </div>
                                        @if ($product->sale_price > 10)
                                            <div class="product-action-1 show">
                                                <a aria-label="Add To Cart" class="action-btn hover-up js-addwish-b3" href="#" wire:click.prevent="store({{ $product->id}},'{{ $product->name }}',{{ $product->sale_price }} )"><i class="fi-rs-shopping-bag-add"></i></a>
                                            </div>
                                        @else
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up js-addwish-b3" href="#" wire:click.prevent="store({{ $product->id}},'{{ $product->name }}',{{ $product->regular_price }} )"><i class="fi-rs-shopping-bag-add"></i></a> 
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>                            
                        @endforeach
                            
                        </div>
                        <!--pagination-->
                        <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-start">
                                    {{ $products->onEachSide(3)->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar">
                        <div class="row">
                            <div class="col-lg-12 col-mg-6"></div>
                            <div class="col-lg-12 col-mg-6"></div>
                        </div>
                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated">Category</h5>
                            <ul class="categories">
                                @foreach ($categories as $category)
                                <li><a href="{{ route('product.category',['slug'=>$category->slug]) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Fillter By Price -->
                        <div class="sidebar-widget price_range range mb-30">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">Fill by price</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            <div class="price-filter">
                                <div class="price-filter-inner">
                                    <div id="slider-range" wire:ignore></div>
                                    <div class="price_slider_amount">
                                        <div class="label-input">
                                            {{-- <input type="text" id="amount" name="price" placeholder="Add Your Price"> --}}
                                            <div >
                                                <span>Range:</span>
                                                <span class="text-info"><a style=" color:black">${{ $min_value }}</a></span> - <span class="text-info"><a style=" color:black">${{ $max_value }}</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group">
                                <div class="list-group-item mb-10 mt-10">
                                    <label class="fw-900">Color</label>
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="1" >
                                        {{-- wire:click.prevent="changePageColor('green')" --}}
                                        <label class="form-check-label" for="exampleCheckbox1"><span>Red (56)</span></label>
                                        <br>
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox2" value="">
                                        <label class="form-check-label" for="exampleCheckbox2"><span>Green (78)</span></label>
                                        <br>
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="">
                                        <label class="form-check-label" for="exampleCheckbox3"><span>Blue (54)</span></label>
                                    </div>
                                    <label class="fw-900 mt-15">Item Condition</label>
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="">
                                        <label class="form-check-label" for="exampleCheckbox11"><span>New (1506)</span></label>
                                        <br>
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox21" value="">
                                        <label class="form-check-label" for="exampleCheckbox21"><span>Refurbished (27)</span></label>
                                        <br>
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox31" value="">
                                        <label class="form-check-label" for="exampleCheckbox31"><span>Used (45)</span></label>
                                    </div>
                                </div>
                            </div>
                            <a href="shop.html" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</a>
                        </div>
                        <!-- Product sidebar Widget -->
                        <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">Sản phẩm mới</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            @foreach ($nproducts as $nproductsitem)
                            <div class="single-post clearfix">
                                <div class="image">
                                    <img src="{{ asset('assets/imgs/products')}}/{{ $nproductsitem->image }}" alt="{{ $nproductsitem->name }}">
                                </div>
                                <div class="content pt-10">
                                    <h5><a href="product-details.html">{{ $nproductsitem->name }}</a></h5>
                                    @if ($nproductsitem->sale_price > 0)
                                        <p class="price mb-0 mt-5">${{ number_format($nproductsitem->sale_price) }}</p>
                                    @else
                                        <p class="price mb-0 mt-5">${{ number_format($nproductsitem->regular_price) }}</p>
                                    @endif
                                    <div class="product-rate">
                                        <div class="product-rating" style="width:90%"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="banner-img wow fadeIn mb-45 animated d-lg-block d-none">
                            <img src="{{ asset('assets/imgs/banner/banner-11.jpg')}}" alt="">
                            <div class="banner-text">
                                <span>Khu của phụ nữ</span>
                                <h4>Tiết kiệm 17% với<br>Đầm công sở</h4>
                                <a href="shop.html">Mua ngay <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>


@push('scripts')
    
    {{-- <script>
        function deleteConfirmationn(id) 
        {
            @this.set('product_id',id);
            @this.call('deleteSlide');
            $('#exampleModal').modal('show');
        }

    </script> --}}
    <script>
        var sliderrange = $('#slider-range');
        var amountprice = $('#amount');
        $(function() {
            sliderrange.slider({
                range: true,
                min: 0,
                max: 2000000,
                values: [0, 2000000],
                slide: function(event, ui) {
                    // amountprice.val("$" + ui.values[0] + " - $" + ui.values[1]);
                    @this.set('min_value',ui.values[0]);
                    @this.set('max_value',ui.values[1]);
                }
            });
            // amountprice.val("$" + sliderrange.slider("values", 0) +
            //     " - $" + sliderrange.slider("values", 1));
        });
    </script>
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
