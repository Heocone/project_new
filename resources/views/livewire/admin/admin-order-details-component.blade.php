<div>
    <style>
        nav svg{
            height: 20px;
        }
        nav .hidden{
            display:block;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>
                    <span></span> Chi tiết đơn hàng
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Chi tiết đơn hàng: Id({{ $order->id }})</h3>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.orders') }}" class="btn btn-success float-end">Danh sách đơn hàng</a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <th>Id</th>
                                    <td>{{ $order->id }}</td>
                                    <th>Ngày đặt:</th>
                                    <td>{{ $order->created_at }}</td>
                                    <th>Trạng thái:</th>
                                    <td>{{ $order->status }}</td>
                                    @if ($order->status == 'delivered')
                                        <th>Ngày giao:</th>
                                        <td>{{ $order->delivered_date }}</td>
                                    @else
                                        <th>Ngày hủy:</th>
                                        <td>{{ $order->canceled_date }}</td>
                                    @endif
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    {{-- <div class="col-md-6">
                                        Chi tiết đơn hàng.
                                    </div> --}}
                                    {{-- <div class="col-md-6">
                                        <a href="{{ route('admin.orders') }}" class="btn btn-success pull-right">Danh sách đơn hàng</a>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="wrap-iten-in-cart">
                                    <h3 class="box-title">Thông tin sản phẩm:</h3>
                                    <ul class="products-cart">
                                        <li>
                                            <table class="table shopping-summery text-center clean">
                                                <thead>
                                                    <tr class="main-heading">
                                                        <th scope="col">Ảnh</th>
                                                        <th scope="col">Tên sản phẩm</th>
                                                        <th scope="col">Kích cỡ</th>
                                                        <th scope="col">Màu sắc</th>
                                                        <th scope="col">Giá</th>
                                                        <th scope="col">Số lượng</th>
                                                        <th scope="col">Tổng tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($order->orderItems as $item)
                                                    <tr>
                                                        <td class="image product-thumbnail">
                                                            <img src="{{ asset('assets/imgs/products')}}/{{ $item->product->image }}" alt="{{ $item->product->name }}">
                                                        </td>
                                                        <td class="product-des product-name">
                                                            <h5 class="product-name"><a href="{{ route('product.details',['slug'=>$item->product->slug]) }}">{{ $item->product->name }}</a></h5>
                                                            {{-- <p class="font-xs">Maboriosam in a tonto nesciung eget<br> distingy magndapibus.
                                                            </p> --}}
                                                        </td>
                                                        <td>M</td>
                                                        <td>Green</td>
                                                        <td class="price" data-title="Price"><span>${{ $item->price }} </span></td>
                                                        
                                                        <td class="text-center" data-title="Stock">
                                                            <div class="detail-qty border radius  m-auto">
                                                                <span class="qty-val">{{ $item->quantity }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="text-right" data-title="Cart">
                                                            <span>${{ $item->price * $item->quantity }} </span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </li>
                                        <li>
                                            <div class="table-responsive" >
                                                <table class="table">
                                                    <tr>
                                                        <td class="cart_total_label">Discount {{ $order->code }}<a aria-label="Xóa mã giảm giá" class="action-btn hover-up" href="#"> </a></td>
                                                        <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">${{ number_format($order->discount) }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cart_total_label">Subtotal with discount</td>
                                                        <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">${{ number_format($order->subtotal) }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cart_total_label">Tax</td>
                                                        <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">{{ $order->tax }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cart_total_label">Shipping</td>
                                                        <td class="cart_total_amount"><i class="ti-gift mr-5"></i> Free Shipping</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cart_total_label">Total</td>
                                                        <td class="cart_total_amount"><strong><span class="font-xl fw-900 text-brand">$ {{ number_format($order->total) }}</span></strong></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style=" padding-top: 10px;">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="col-md-6">
                                    <h3>Thông tin đơn hàng:</h3>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table">
                                    <tr>
                                        <th>Họ, tên đệm:</th>
                                        <td>{{ $order->firtsname }}</td>
                                        <th>Tên:</th>
                                        <td>{{ $order->lastname }}</td>
                                    </tr>
                                    <tr>
                                        <th>Số điện thoại:</th>
                                        <td>{{ $order->mobile }}</td>
                                        <th>Email:</th>
                                        <td>{{ $order->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Line1:</th>
                                        <td>{{ $order->line1 }}</td>
                                        <th>Line2:</th>
                                        <td>{{ $order->line2 }}</td>
                                    </tr>
                                    <tr>
                                        <th>City:</th>
                                        <td>{{ $order->city }}</td>
                                        <th>Tỉnh:</th>
                                        <td>{{ $order->province }}</td>
                                    </tr>
                                    <tr>
                                        <th>Đất nước:</th>
                                        <td>{{ $order->country }}</td>
                                        <th>Mã zipcode:</th>
                                        <td>{{ $order->zipcode }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày tạo:</th>
                                        <td>{{ $order->created_at }}</td>
                                        <th>User_id:</th>
                                        <td>{{ $order->user_id }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                @if($order->is_shipping_different)
                <div class="row" style=" padding-top: 10px;">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Shipping Details:
                            </div>
                            <div class="panel-body">
                                <table class="table">
                                    <tr>
                                        <th>Họ, tên đệm:</th>
                                        <td>{{ $order->shipping->firtsname }}</td>
                                        <th>Tên:</th>
                                        <td>{{ $order->shipping->lastname }}</td>
                                    </tr>
                                    <tr>
                                        <th>Số điện thoại:</th>
                                        <td>{{ $order->shipping->mobile }}</td>
                                        <th>Email:</th>
                                        <td>{{ $order->shipping->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Line1:</th>
                                        <td>{{ $order->shipping->line1 }}</td>
                                        <th>Line2:</th>
                                        <td>{{ $order->shipping->line2 }}</td>
                                    </tr>
                                    <tr>
                                        <th>City:</th>
                                        <td>{{ $order->shipping->city }}</td>
                                        <th>Tỉnh:</th>
                                        <td>{{ $order->shipping->province }}</td>
                                    </tr>
                                    <tr>
                                        <th>Đất nước:</th>
                                        <td>{{ $order->shipping->country }}</td>
                                        <th>Mã zipcode:</th>
                                        <td>{{ $order->shipping->zipcode }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày tạo:</th>
                                        <td>{{ $order->shipping->created_at }}</td>
                                        <th>User_id:</th>
                                        <td>{{ $order->shipping->user_id }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <h3>No shipping defferent</h3>
                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Shipping Details
                            </div>
                        <div class="panel-body">
                        </div>
                    </div>
                </div>
                </div> --}}
                @endif
                <div class="row" style=" padding-top: 10px;">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>Transaction:</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table">
                                    @if ($order->transaction)
                                        @if($order->transaction->mode == 'cod')
                                        <tr>
                                            <th>Transaction mode:</th>
                                            <td>Thanh toán khi nhận hàng</td>   
                                        </tr>
                                        @else
                                        <tr>
                                            <th>Transaction mode:</th>
                                            <td>{{ $order->transaction->mode }}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th>Status</th>
                                            <td>{{ $order->transaction->status }}</td>
                                        </tr>
                                        <tr>
                                            <th>Transaxtion Date</th>
                                            <td>{{ $order->transaction->created_at }}</td>
                                        </tr>
                                    @else
                                    <tr>
                                        <th>Transaction mode:</th>
                                        <td>Thanh toán lỗi</td>   
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>