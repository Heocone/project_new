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
                    <span></span> Danh sách đơn hàng
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Danh sách đơn hàng</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                            @endif
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        {{-- <th>Đơn hàng phụ</th>
                                        <th>Giảm giá</th>
                                        <th>Thuế</th> --}}
                                        <th>Đơn hàng tổng</th>
                                        <th>Họ, tên đệm</th>
                                        <th>Tên</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th>Zipcode</th>
                                        <th>Status</th>
                                        <th>Ngày tạo</th>
                                        <th colspan="2" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            {{-- <td>${{ $order->subtotal }}</td>
                                            <td>${{ $order->discount }}</td>
                                            <td>${{ $order->tax }}</td> --}}
                                            <td>${{ $order->total }}</td>
                                            <td>{{ $order->firtsname }}</td>
                                            <td>{{ $order->lastname }}</td>
                                            <td>{{ $order->mobile }}</td>
                                            <td>{{ $order->email }}</td>
                                            <td>{{ $order->zipcode }}</td>
                                            <td>
                                                @if ($order->status == 'delivered')
                                                    <a>Đã giao hàng</a>
                                                @elseif($order->status == 'canceled')
                                                    <a>Đã Hủy</a>
                                                @elseif($order->status == 'ordered')
                                                    <a>Đang giao hàng</a>
                                                @endif
                                                {{-- {{ $order->status }} --}}
                                            </td>
                                            <td>{{ $order->created_at }}</td>
                                            {{-- <td><a href="{{ route('admin.orderdetails',['order_id' => $order->id]) }}" class="btn btn-info btn-sm">Details</a></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Trạng thái
                                                        <span class="caret"></span>
                                                    </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#" wire:click.prevent="updateOrderStatus({{ $order->id }},'delivered')">Đã giao hàng</a></li>
                                                            <li><a href="#" wire:click.prevent="updateOrderStatus({{ $order->id }},'canceled')">Hủy đơn</a></li>
                                                        </ul>
                                                </div>
                                            </td> --}}
                                            <td>
                                                <a href="{{ route('user.orderdetail',['order_id' => $order->id]) }}" class="text-info"><i class=" fa fi-rs-eye"></i></a>
                                                @if($order->status == 'ordered')
                                                <a href="#" onclick="return confirm('Are you sure about that?')|| event.stopImmediatePropagation()" wire:click.prevent="cancelOrder()" style="margin-right:20px;" class="btn btn-warning float-end">Hủy</a>
                                                @elseif($order->status == 'canceled')  
                                                <a href="/shop" style="margin-right:20px; width:87px" class="btn btn-success float-end" >Mua lại</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
