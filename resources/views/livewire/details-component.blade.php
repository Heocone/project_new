<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow">Trang chủ</a>
                <span></span> <a href="{{ route('product.category',['slug'=>$product->category->slug]) }}">{{ $product->category->name }}</a>
                <span></span> {{ $product->name }}
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50 product_data">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-gallery">
                                    <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider" wire:ignore>
                                        <figure class="border-radius-10">
                                            <img src="{{ asset('assets/imgs/products')}}/{{ $product->image }}" alt="{{ $product->name }}">
                                        </figure>
                                        <figure class="border-radius-10">
                                            <img src="{{ asset('assets/imgs/products')}}/{{ $product->image2 }}" alt="{{ $product->name }}">
                                        </figure>
                                        @php
                                            $images = explode(',', $product->images);
                                        @endphp
                                        @foreach ($images as $image)
                                            @if ($image)
                                                <figure class="border-radius-10">
                                                    <img src="{{ asset('assets/imgs/products')}}/{{ $image }}" alt="{{ $product->name }}">
                                                </figure>
                                            @endif
                                        @endforeach
                                    </div>
                                    <!-- THUMBNAILS -->
                                    <div class="slider-nav-thumbnails pl-15 pr-15" wire:ignore>
                                        <div>                                            
                                            <img src="{{ asset('assets/imgs/products')}}/{{ $product->image }}" alt="product image">
                                        </div>
                                        <div>
                                            <img src="{{ asset('assets/imgs/products')}}/{{ $product->image }}" alt="product image">
                                        </div>
                                        @foreach ($images as $image)
                                            @if ($image)
                                                <div>
                                                    <img src="{{ asset('assets/imgs/products')}}/{{ $image }}" alt="{{ $product->name }}">
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <!-- End Gallery -->
                                <div class="social-icons single-share">
                                    <ul class="text-grey-5 d-inline-block">
                                        <li><strong class="mr-10">Chia sẻ:</strong></li>
                                        <li class="social-facebook"><a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-facebook.svg')}}" alt=""></a></li>
                                        <li class="social-twitter"> <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-twitter.svg')}}" alt=""></a></li>
                                        <li class="social-instagram"><a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-instagram.svg')}}" alt=""></a></li>
                                        <li class="social-linkedin"><a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-pinterest.svg')}}" alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info">
                                    <h2 class="title-detail">{{ $product->name }}</h2>
                                    <div class="product-detail-rating">
                                        <div class="pro-details-brand">
                                            <span> Thương hiệu: <a href="shop.html">Add in future</a></span>
                                        </div>
                                        <div class="product-rate-cover text-end">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:90%">
                                                </div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (25 đánh giá)</span>
                                        </div>
                                    </div>
                                    <div class="clearfix product-price-cover">
                                        @if ($product->sale_price > 0)
                                        <div class="product-price primary-color float-left">
                                            <ins><span class="text-brand">${{ number_format($product->sale_price) }}</span></ins>
                                            <ins><span class="old-price font-md ml-15">${{ number_format($product->regular_price) }}</span></ins>
                                            @php
                                                $chia = $product->sale_price / $product->regular_price;
                                                $nhan = $chia * 100;
                                                $phantram = 100 - $nhan;
                                            @endphp
                                            <span class="save-price  font-md color3 ml-15">{{ number_format($phantram) }}% Off</span>
                                        </div>
                                        @else
                                        <div class="product-price primary-color float-left">
                                            <ins><span class="text-brand">${{ number_format($product->regular_price) }}</span></ins>
                                            {{-- <ins><span class="old-price font-md ml-15">$200.00</span></ins>
                                            <span class="save-price  font-md color3 ml-15">25% Off</span> --}}
                                        </div>
                                        @endif
                                        
                                    </div>
                                    <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                    <div class="short-desc mb-30">
                                        <p>{!! $product->short_description !!}</p>
                                    </div>
                                    <div class="product_sort_info font-xs mb-30">
                                        <ul>
                                            <li class="mb-10"><i class="fi-rs-crown mr-5"></i> Bảo hành thương hiệu AL Jazeera 1 năm.</li>
                                            <li class="mb-10"><i class="fi-rs-refresh mr-5"></i> Chính sách hoàn trả trong 30 ngày.</li>
                                            <li><i class="fi-rs-credit-card mr-5"></i> Thanh toán khi nhận hàng.</li>
                                        </ul>
                                    </div>
                                    <div class="attr-detail attr-color mb-15">
                                        @foreach ($product->attributeValues->unique('product_attribute_id') as $av)
                                        <div class="row" style="margin-top:20px;">
                                            <div class="col-xs-2">
                                                <p><h3>{{ $av->productAttribute->name }}</h3></p>
                                            </div>
                                            <div class="col-xs-10">
                                                <select class="form-control" style="width:200px" name="" id="" required wire:model="satt.{{ $av->productAttribute->name }}">
                                                    <option value="">Chọn <h3>{{$av->productAttribute->name}}</h3></option>
                                                    @if ($av->productAttribute->name == 'Color')
                                                        @foreach ($av->productAttribute->attributeValues->where('product_id',$product->id) as $pav)
                                                        <option value="{{ $pav->value }}"><span class="product-color-{{ $pav->value }}"></span>{{ $pav->value }}</option>
                                                        @endforeach
                                                    @endif
                                                    @if ($av->productAttribute->name == 'Size')
                                                        @foreach ($av->productAttribute->attributeValues->where('product_id',$product->id) as $pav)
                                                        <option value="{{ $pav->value }}">{{ $pav->value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    {{-- @foreach ($product->attributeValues->unique('product_attribute_id') as $av)
                                        @if ($av->productAttribute->name == 'Color')
                                        <div class="attr-detail attr-color mb-15">
                                            <strong class="mr-10">{{ $av->productAttribute->name }}:</strong>
                                            <ul class="list-filter color-filter" >
                                                @foreach ($av->productAttribute->attributeValues->where('product_id',$product->id) as $pav)
                                                <li wire:model="color"><a href="#" data-color="{{ $pav->value }}"><span class="product-color-{{ $pav->value }}"></span></a></li>
                                                @endforeach
                                                {{-- <li><a href="#" data-color="Yellow"><span class="product-color-yellow"></span></a></li>
                                                <li class="active"><a href="#" data-color="White"><span class="product-color-white"></span></a></li>
                                                <li><a href="#" data-color="Orange"><span class="product-color-orange"></span></a></li>
                                                <li><a href="#" data-color="Cyan"><span class="product-color-cyan"></span></a></li>
                                                <li><a href="#" data-color="Green"><span class="product-color-green"></span></a></li>
                                                <li><a href="#" data-color="Purple"><span class="product-color-purple"></span></a></li> 
                                            </ul>
                                        </div>
                                        @endif
                                        @if ($av->productAttribute->name == 'Size')
                                            <div class="attr-detail attr-size">
                                                <strong class="mr-10">{{ $av->productAttribute->name }}:</strong>
                                                <ul class="list-filter size-filter font-small">
                                                    @foreach ($av->productAttribute->attributeValues->where('product_id',$product->id) as $pav)
                                                    <li><a href="#" class="sizeValue">{{ $pav->value }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    @endforeach --}}
                                    <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                    <div class="detail-extralink">
                                        <div class="detail-qty border radius">
                                            <a href="#" class="qty-down" wire:click.prevent="decreaseQuantity"><i class="fi-rs-angle-small-down"></i></a>
                                            <span class="qty-val" wire:model="qty">{{ $qty }}</span>
                                            <a href="#" class="qty-up" wire:click.prevent="increaseQuantity"><i class="fi-rs-angle-small-up"></i></a>
                                        </div>
                                        <div class="product-extra-link2">
                                            @if (!$product->quantity < 1)
                                                @if ($product->sale_price > 1)
                                                <button type="button" class="button button-add-to-cart" wire:click.prevent="store({{ $product->id}},'{{ $product->name }}',{{ $product->sale_price }} )">Thêm vào giỏ hàng</button>
                                                @else
                                                <button type="button" class="button button-add-to-cart" wire:click.prevent="store({{ $product->id}},'{{ $product->name }}',{{ $product->regular_price }} )">Thêm vào giỏ hàng</button>
                                                @endif
                                                <a aria-label="Add To Wishlist" class="action-btn hover-up" href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i class="fi-rs-shuffle"></i></a>
                                            @else
                                                
                                                {{-- <h5>Xin lỗi quý khách sản phẩm này đã hết hàng</h5>
                                                <h6>Quý khách vui lòng liên hệ với shop để đặt hàng trực tiếp</h6>
                                                <h6>Xin quý khách thông cảm</h6> --}}
                                                <a aria-label="Add To Wishlist" class="action-btn hover-up" href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i class="fi-rs-shuffle"></i></a>    
                                                <p class="font-xs">Sản phẩm này đã bán hết Quý khách<br>  vui lòng liên hệ với shop để đặt hàng trực tiếp.
                                                </p>
                                            @endif
                                            
                                        </div>
                                    </div>
                                    <ul class="product-meta font-xs color-grey mt-50">
                                        <li class="mb-5">Mã vạch: <a>{{ $product->SKU }}</a></li>
                                        <li class="mb-5">Tags: <a href="#" rel="tag">Cloth</a>, <a href="#" rel="tag">Women</a>, <a href="#" rel="tag">Dress</a> </li>
                                        <li>Số lượng:<span class="in-stock text-success ml-5">{{ $product->quantity }} sản phẩm</span></li>
                                    </ul>
                                </div>
                                <!-- Detail Info -->
                            </div>
                        </div>
                        <div class="tab-style3">
                            <ul class="nav nav-tabs text-uppercase">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Mô tả sản phẩm</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Thông tin bổ sung
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Dánh giá (3)</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab entry-main-content">
                                <div class="tab-pane fade show active" id="Description">
                                    <div class="">
                                        <p>{!! $product->description !!}</p>
                                        {{-- <p>Uninhibited carnally hired played in whimpered dear gorilla koala depending and much yikes off far quetzal goodness and from for grimaced goodness unaccountably and meadowlark near unblushingly crucial scallop
                                            tightly neurotic hungrily some and dear furiously this apart.</p>
                                        <p>Spluttered narrowly yikes left moth in yikes bowed this that grizzly much hello on spoon-fed that alas rethought much decently richly and wow against the frequent fluidly at formidable acceptably flapped
                                            besides and much circa far over the bucolically hey precarious goldfinch mastodon goodness gnashed a jellyfish and one however because.
                                        </p>
                                        <ul class="product-more-infor mt-30">
                                            <li><span>Type Of Packing</span> Bottle</li>
                                            <li><span>Color</span> Green, Pink, Powder Blue, Purple</li>
                                            <li><span>Quantity Per Case</span> 100ml</li>
                                            <li><span>Ethyl Alcohol</span> 70%</li>
                                            <li><span>Piece In One</span> Carton</li>
                                        </ul>
                                        <hr class="wp-block-separator is-style-dots">
                                        <p>Laconic overheard dear woodchuck wow this outrageously taut beaver hey hello far meadowlark imitatively egregiously hugged that yikes minimally unanimous pouted flirtatiously as beaver beheld above forward
                                            energetic across this jeepers beneficently cockily less a the raucously that magic upheld far so the this where crud then below after jeez enchanting drunkenly more much wow callously irrespective limpet.</p>
                                        <h4 class="mt-30">Packaging & Delivery</h4>
                                        <hr class="wp-block-separator is-style-wide">
                                        <p>Less lion goodness that euphemistically robin expeditiously bluebird smugly scratched far while thus cackled sheepishly rigid after due one assenting regarding censorious while occasional or this more crane
                                            went more as this less much amid overhung anathematic because much held one exuberantly sheep goodness so where rat wry well concomitantly.
                                        </p>
                                        <p>Scallop or far crud plain remarkably far by thus far iguana lewd precociously and and less rattlesnake contrary caustic wow this near alas and next and pled the yikes articulate about as less cackled dalmatian
                                            in much less well jeering for the thanks blindly sentimental whimpered less across objectively fanciful grimaced wildly some wow and rose jeepers outgrew lugubrious luridly irrationally attractively
                                            dachshund.
                                        </p> --}}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Additional-info">
                                    <table class="font-md">
                                        <tbody>
                                            <tr class="stand-up">
                                                <th>Stand Up</th>
                                                <td>
                                                    <p>35″L x 24″W x 37-45″H(front to back wheel)</p>
                                                </td>
                                            </tr>
                                            <tr class="folded-wo-wheels">
                                                <th>Folded (w/o wheels)</th>
                                                <td>
                                                    <p>32.5″L x 18.5″W x 16.5″H</p>
                                                </td>
                                            </tr>
                                            <tr class="folded-w-wheels">
                                                <th>Folded (w/ wheels)</th>
                                                <td>
                                                    <p>32.5″L x 24″W x 18.5″H</p>
                                                </td>
                                            </tr>
                                            <tr class="door-pass-through">
                                                <th>Door Pass Through</th>
                                                <td>
                                                    <p>24</p>
                                                </td>
                                            </tr>
                                            <tr class="frame">
                                                <th>Frame</th>
                                                <td>
                                                    <p>Aluminum</p>
                                                </td>
                                            </tr>
                                            <tr class="weight-wo-wheels">
                                                <th>Weight (w/o wheels)</th>
                                                <td>
                                                    <p>20 LBS</p>
                                                </td>
                                            </tr>
                                            <tr class="weight-capacity">
                                                <th>Weight Capacity</th>
                                                <td>
                                                    <p>60 LBS</p>
                                                </td>
                                            </tr>
                                            <tr class="width">
                                                <th>Width</th>
                                                <td>
                                                    <p>24″</p>
                                                </td>
                                            </tr>
                                            <tr class="handle-height-ground-to-handle">
                                                <th>Handle height (ground to handle)</th>
                                                <td>
                                                    <p>37-45″</p>
                                                </td>
                                            </tr>
                                            <tr class="wheels">
                                                <th>Wheels</th>
                                                <td>
                                                    <p>12″ air / wide track slick tread</p>
                                                </td>
                                            </tr>
                                            <tr class="seat-back-height">
                                                <th>Seat back height</th>
                                                <td>
                                                    <p>21.5″</p>
                                                </td>
                                            </tr>
                                            <tr class="head-room-inside-canopy">
                                                <th>Head room (inside canopy)</th>
                                                <td>
                                                    <p>25″</p>
                                                </td>
                                            </tr>
                                            <tr class="pa_color">
                                                <th>Color</th>
                                                <td>
                                                    <p>Black, Blue, Red, White</p>
                                                </td>
                                            </tr>
                                            <tr class="pa_size">
                                                <th>Size</th>
                                                <td>
                                                    <p>M, S</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="Reviews">
                                    <!--Comments-->
                                    <div class="comments-area">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h4 class="mb-30">Câu hỏi và câu trả lời của khách hàng</h4>
                                                <div class="comment-list">
                                                    <div class="single-comment justify-content-between d-flex">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="{{ asset('assets/imgs/page/avatar-6.jpg')}}" alt="">
                                                                <h6><a href="#">Jacky Chan</a></h6>
                                                                <p class="font-xxs">Since 2012</p>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="product-rate d-inline-block">
                                                                    <div class="product-rating" style="width:90%">
                                                                    </div>
                                                                </div>
                                                                <p>Thank you very fast shipping from Poland only 3days.</p>
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="d-flex align-items-center">
                                                                        <p class="font-xs mr-30">December 4, 2020 at 3:12 pm </p>
                                                                        <a href="#" class="text-brand btn-reply">Reply <i class="fi-rs-arrow-right"></i> </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--single-comment -->
                                                    <div class="single-comment justify-content-between d-flex">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="{{ asset('assets/imgs/page/avatar-7.jpg')}}" alt="">
                                                                <h6><a href="#">Ana Rosie</a></h6>
                                                                <p class="font-xxs">Since 2008</p>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="product-rate d-inline-block">
                                                                    <div class="product-rating" style="width:90%">
                                                                    </div>
                                                                </div>
                                                                <p>Great low price and works well.</p>
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="d-flex align-items-center">
                                                                        <p class="font-xs mr-30">December 4, 2020 at 3:12 pm </p>
                                                                        <a href="#" class="text-brand btn-reply">Reply <i class="fi-rs-arrow-right"></i> </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--single-comment -->
                                                    <div class="single-comment justify-content-between d-flex">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="{{ asset('assets/imgs/page/avatar-8.jpg')}}" alt="">
                                                                <h6><a href="#">Steven Keny</a></h6>
                                                                <p class="font-xxs">Since 2010</p>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="product-rate d-inline-block">
                                                                    <div class="product-rating" style="width:90%">
                                                                    </div>
                                                                </div>
                                                                <p>Authentic and Beautiful, Love these way more than ever expected They are Great earphones</p>
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="d-flex align-items-center">
                                                                        <p class="font-xs mr-30">December 4, 2020 at 3:12 pm </p>
                                                                        <a href="#" class="text-brand btn-reply">Reply <i class="fi-rs-arrow-right"></i> </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--single-comment -->
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <h4 class="mb-30">Đánh giá của khách hàng</h4>
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width:90%">
                                                        </div>
                                                    </div>
                                                    <h6>4.8 out of 5</h6>
                                                </div>
                                                <div class="progress">
                                                    <span>5 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>4 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>3 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>2 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                                                </div>
                                                <div class="progress mb-30">
                                                    <span>1 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                                </div>
                                                <a href="#" class="font-xs text-muted">?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--comment form-->
                                    <div class="comment-form">
                                        <h4 class="mb-15">Add a review</h4>
                                        <div class="product-rate d-inline-block mb-30">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-12">
                                                <form class="form-contact comment_form" action="#" id="commentForm">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <input class="form-control" name="website" id="website" type="text" placeholder="Website">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="button button-contactForm">Submit
                                                            Review</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-60">
                            <div class="col-12">
                                <h3 class="section-title style-1 mb-30">Sản phẩm liên quan</h3>
                            </div>
                            <div class="col-12">
                                <div class="row related-products">
                                    @foreach ($rproducts as $rproductitem)
                                    <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                        <div class="product-cart-wrap small hover-up">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="{{ route('product.details',['slug'=>$rproductitem->slug]) }}" tabindex="0">
                                                        <img class="default-img" src="{{ asset('assets/imgs/products')}}/{{ $rproductitem->image }}" alt="{{ $rproductitem->name }}">
                                                        <img class="hover-img" src="{{ asset('assets/imgs/products')}}/{{ $rproductitem->image }}" alt="{{ $rproductitem->name }}">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-search"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="wishlist.php" tabindex="0"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up" href="compare.php" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">Hot</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <h2><a href="{{ route('product.details',['slug'=>$rproductitem->slug]) }}" tabindex="0">{{ $rproductitem->name }}</a></h2>
                                                <div class="rating-result" title="90%">
                                                    <span>
                                                    </span>
                                                </div>
                                                <div class="product-price">
                                                    @if ($rproductitem->sale_price > 0)
                                                        <span>${{ number_format($rproductitem->sale_price) }}</span> </span>
                                                        <span class="old-price">${{ $rproductitem->regular_price }}</span>
                                                    @else
                                                    <span>${{ number_format($rproductitem->regular_price) }}</span> </span>
                                                    @endif
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>                            
                    </div>
                </div>
                <div class="col-lg-3 primary-sidebar sticky-sidebar" wire:ignore>
                    <div class="widget-category mb-30">
                        <h5 class="section-title style-1 mb-30 wow fadeIn animated">Danh mục</h5>
                        <ul class="categories">
                            @foreach ($categories as $category)
                            <li><a href="{{ route('product.category',['slug'=>$category->slug]) }}">{{ $category->name }}</a></li>
                            @endforeach
                            {{-- <li><a href="shop.html">Blouses & Shirts</a></li>
                            <li><a href="shop.html">Dresses</a></li>
                            <li><a href="shop.html">Swimwear</a></li>
                            <li><a href="shop.html">Beauty</a></li>
                            <li><a href="shop.html">Jewelry & Watch</a></li>
                            <li><a href="shop.html">Accessories</a></li> --}}
                        </ul>
                    </div>
                            
                    <!-- Product sidebar Widget -->
                    <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">Sản phẩm mới</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        @foreach ($nproducts as $nproductitem)
                        <div class="single-post clearfix">
                            <div class="image" >
                                <img src="{{ asset('assets/imgs/products')}}/{{ $nproductitem->image }}" alt="{{ $nproductitem->name }}">
                            </div>
                            <div class="content pt-10">
                                <h5><a href="{{ route('product.details',['slug'=>$nproductitem->slug]) }}">{{ $nproductitem->name }}</a></h5>
                                @if ($nproductitem->sale_price > 0)
                                    <p class="price mb-0 mt-5">${{ number_format($nproductitem->sale_price) }}</p>
                                @else
                                    <p class="price mb-0 mt-5">${{ number_format($nproductitem->regular_price) }}</p>
                                @endif
                                <div class="product-rate">
                                    <div class="product-rating" style="width:90%"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>                        
                </div>
            </div>
        </div>
    </section>
</main>
</div>

{{-- @push('scripts')
    <script>
         $('.getSize').on('click', function(e) {
            e.preventDefault();
        });

        $('.getSize').each(function() {
            var nameProduct = $(this).closest('.product_data').find('.product_size').val();
            $(this).on('click', function() {
                swal(nameProduct, "đã được thêm vào danh sách sản phẩm yêu thích !", "success");
            });
        });
    </script>
@endpush --}}