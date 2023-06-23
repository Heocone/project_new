<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow">Home</a>                    
                <span></span> My Account
            </div>
        </div>
    </div>
    <section class="pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <div class="col-md-4">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders" role="tab" aria-controls="track-orders" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>My Address</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fi-rs-user mr-10"></i>Account details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="login.html"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="tab-content dashboard-content">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Hello {{ Auth::user()->name }}! </h5>
                                        </div>
                                        <div class="card-body">
                                            {{-- <p>From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a></p> --}}
                                            <p>Từ bảng điều khiển tài khoản của bạn. bạn có thể dễ dàng kiểm tra và xem các đơn đặt hàng gần đây của mình, quản lý địa chỉ giao hàng và thanh toán cũng như chỉnh sửa mật khẩu và chi tiết tài khoản của bạn.</p>
                                            <div class="content">   
                                                <style>
                                                    .content {
                                                      padding-top: 40px;
                                                      padding-bottom: 40px;
                                                    }
                                                    .icon-stat {
                                                        display: block;
                                                        overflow: hidden;
                                                        position: relative;
                                                        padding: 15px;
                                                        margin-bottom: 1em;
                                                        background-color: #fff;
                                                        border-radius: 4px;
                                                        border: 1px solid #ddd;
                                                    }
                                                    .icon-stat-label {
                                                        display: block;
                                                        color: #999;
                                                        font-size: 13px;
                                                    }
                                                    .icon-stat-value {
                                                        display: block;
                                                        font-size: 28px;
                                                        font-weight: 600;
                                                    }
                                                    .icon-stat-visual {
                                                        position: relative;
                                                        top: 22px;
                                                        display: inline-block;
                                                        width: 32px;
                                                        height: 32px;
                                                        border-radius: 4px;
                                                        text-align: center;
                                                        font-size: 16px;
                                                        line-height: 30px;
                                                    }
                                                    .bg-primary {
                                                        color: #fff;
                                                        background: #d74b4b;
                                                    }
                                                    .bg-secondary {
                                                        color: #fff;
                                                        background: #6685a4;
                                                    }
                                                    
                                                    .icon-stat-footer {
                                                        padding: 10px 0 0;
                                                        margin-top: 10px;
                                                        color: #aaa;
                                                        font-size: 12px;
                                                        border-top: 1px solid #eee;
                                                    }
                                                </style>
                                                    <div class="row">
                                                        <div class="col-md-3 col-sm-6">    
                                                          <div class="icon-stat">    
                                                            <div class="row">
                                                              <div class="col-xs-8 text-left">
                                                                <span class="icon-stat-label">Tổng:</span>
                                                                <br>
                                                                <span class="icon-stat-value"><h4>${{ $totalCost }}</h4></span>
                                                              </div>   
                                                              {{-- <div class="col-xs-4 text-center">
                                                                <i class="fi fi-rs-dollar icon-stat-visual bg-primary"></i>
                                                              </div> --}}
                                                            </div>    
                                                            <div class="icon-stat-footer">
                                                              <i class="fi fi-rs-clock"></i> Updated Now
                                                            </div>    
                                                          </div>    
                                                        </div>    
                                                        <div class="col-md-3 col-sm-6">    
                                                          <div class="icon-stat">    
                                                            <div class="row">
                                                              <div class="col-xs-8 text-left">
                                                                <span class="icon-stat-label">Số lần mua:</span>
                                                                <span class="icon-stat-value"><h5>{{ $totalPurchase }}</h5></span>
                                                              </div>    
                                                              {{-- <div class="col-xs-4 text-center">
                                                                <i class="fi fi-rs-bank icon-stat-visual bg-secondary"></i>
                                                              </div> --}}
                                                            </div>    
                                                            <div class="icon-stat-footer">
                                                              <i class="fi fi-rs-alarm-clock"></i>Updated Now
                                                            </div>   
                                                          </div>
                                                        </div>
                                                        <div class="col-md-3 col-sm-6">    
                                                          <div class="icon-stat">    
                                                            <div class="row">
                                                              <div class="col-xs-8 text-left">
                                                                <span class="icon-stat-label">Đơn hàng đã giao:</span>
                                                                <span class="icon-stat-value"><h5>{{ $totalDelivered }}</h5></span>
                                                              </div>    
                                                              {{-- <div class="col-xs-4 text-center">
                                                                <i class="fi fi-rs-dollar icon-stat-visual bg-primary"></i>
                                                              </div> --}}
                                                            </div>    
                                                            <div class="icon-stat-footer">
                                                              <i class="fi fi-rs-clock"></i> Updated Now
                                                            </div>
                                                          </div>    
                                                        </div>    
                                                        <div class="col-md-3 col-sm-6">    
                                                          <div class="icon-stat">    
                                                            <div class="row">
                                                              <div class="col-xs-8 text-left">
                                                                <span class="icon-stat-label">Số đơn hủy:</span>
                                                                <span class="icon-stat-value"><h5>{{ $totalCanceled }}</h5></span>
                                                              </div>    
                                                              {{-- <div class="col-xs-4 text-center">
                                                                <i class="fi fi-rs-bank icon-stat-visual bg-secondary"></i>
                                                              </div> --}}
                                                            </div>    
                                                            <div class="icon-stat-footer">
                                                              <i class="fi fi-rs-clock"></i> Updated Now
                                                            </div>    
                                                          </div>    
                                                        </div>    
                                                      </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Đơn hàng của bạn</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Ngày tạo</th>
                                                            <th>Trạng thái</th>
                                                            <th>Tổng</th>
                                                            <th>Công cụ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($orders as $order)
                                                        <tr>
                                                            <td>#{{ $order->id }}</td>
                                                            <td>{{ $order->created_at }}</td>
                                                            <td>@if ($order->status == 'delivered')
                                                                <a>Đã giao hàng</a>
                                                            @elseif($order->status == 'canceled')
                                                                <a>Đã Hủy</a>
                                                            @elseif($order->status == 'ordered')
                                                                <a>Đang giao hàng</a>
                                                            @endif</td>
                                                            <td>${{ $order->total }}</td>
                                                            <td><a href="{{ route('user.orderdetail',['order_id' => $order->id]) }}" class="btn-small d-block"><i class=" fa fi-rs-eye" style="position:relative;top:2px;"></i> View</a></td>
                                                        </tr>
                                                        @endforeach
                                                        {{-- <tr>
                                                            <td>#2468</td>
                                                            <td>June 29, 2022</td>
                                                            <td>Completed</td>
                                                            <td>$364.00 for 5 item</td>
                                                            <td><a href="#" class="btn-small d-block">View</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>#2366</td>
                                                            <td>August 02, 2022</td>
                                                            <td>Completed</td>
                                                            <td>$280.00 for 3 item</td>
                                                            <td><a href="#" class="btn-small d-block">View</a></td>
                                                        </tr> --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Orders tracking</h5>
                                        </div>
                                        <div class="card-body contact-from-area">
                                            <p>To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <form class="contact-form-style mt-30 mb-50" action="#" method="post">
                                                        <div class="input-style mb-20">
                                                            <label>Order ID</label>
                                                            <input name="order-id" placeholder="Found in your order confirmation email" type="text" class="square">
                                                        </div>
                                                        <div class="input-style mb-20">
                                                            <label>Billing email</label>
                                                            <input name="billing-email" placeholder="Email you used during checkout" type="email" class="square">
                                                        </div>
                                                        <button class="submit submit-auto-width" type="submit">Track</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card mb-3 mb-lg-0">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Billing Address</h5>
                                                </div>
                                                <div class="card-body">
                                                    @if (Auth::check())
                                                        <address>{{ Auth::user()->line1 }}<br> 00 Business Spur,<br> Sault Ste. <br>Marie, MI 00000</address>
                                                        <p>New York</p>
                                                        <a href="#" class="btn-small">Edit</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Shipping Address</h5>
                                                </div>
                                                <div class="card-body">
                                                    <address>4299 Express Lane<br>
                                                        Sarasota, <br>FL 00000 USA <br>Phone: 1.000.000.0000</address>
                                                    <p>Sarasota</p>
                                                    <a href="#" class="btn-small">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Account Details</h5>
                                        </div>
                                        <div class="card-body">
                                            {{-- <p>Already have an account? <a href="login.html">Log in instead!</a></p> --}}
                                            <form method="post" name="enq">
                                                <div class="row">
                                                    @if($user->profile->image)
                                                        <div class="form-group col-md-6">
                                                            <label>Avatar <span class="required"></span></label>
                                                            <img src="{{ asset('assets/imgs/profile') }}/{{ $user->profile->image }}" alt="">
                                                        </div>
                                                    @else
                                                    <style>
                                                        .thumb img {
                                                            width: 220px !important;
                                                            border-radius: 50% !important;
                                                        }
                                                    </style>
                                                        <div class="thumb form-group col-md-6">
                                                            <label>Avatar <span class="required"></span></label>
                                                            <img src="{{ asset('assets/imgs/page/avatar-7.jpg')}}" alt="">
                                                        </div>
                                                    @endif
                                                    {{-- <div class="form-group col-md-6">
                                                        <label>Last Name <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="phone">
                                                    </div> --}}
                                                    <div class="form-group col-md-6">
                                                    <p><b>Họ tên:</b>{{ $user->name }}</p>
                                                    <p><b>Email:</b>{{ $user->email }}</p>
                                                    <p><b>Số điện thoại:</b>{{ $user->profile->mobile }}</p>
                                                    <p><b>Số nhà:</b>{{ $user->profile->line1 }}</p>
                                                    <p><b>Huyện:</b>{{ $user->profile->line2 }}</p>
                                                    <p><b>Thành phố:</b>{{ $user->profile->city }}</p>
                                                    <p><b>Tỉnh:</b>{{ $user->profile->province }}</p>
                                                    <p><b>Đất nước:</b>{{ $user->profile->country }}</p>
                                                    <p><b>Zip code:</b>{{ $user->profile->zipcode }}</p>
                                                    </div>
                                                    <a href="{{ route('user.editprofile') }}" class="btn btn-info pull-right">Cập nhật thông tin tài khoản</a>
                                                    {{-- <div class="form-group col-md-6">
                                                        <label>Last Name <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="phone">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Display Name <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="dname" type="text">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Email Address <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="email" type="email">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Current Password <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="password" type="password">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>New Password <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="npassword" type="password">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Confirm Password <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="cpassword" type="password">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-fill-out submit" name="submit" value="Submit">Save</button>
                                                    </div> --}}
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>