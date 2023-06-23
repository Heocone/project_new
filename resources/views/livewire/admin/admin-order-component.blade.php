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
                            @if (Session::has('order_message'))
                                <div class="alert alert-success" role="alert">{{ Session::get('order_message') }}</div>
                            @endif
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        {{-- <th>Đơn hàng phụ</th>
                                        <th>Giảm giá</th>
                                        <th>Thuế</th>--}}
                                        <th>Tổng tiền</th>
                                        <th>Họ, tên đệm</th>
                                        <th>Tên</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th>Zipcode</th>
                                        <th>Status</th>
                                        <th>Ngày tạo</th>
                                        <th colspan="2" class="text-center">Action</th>
                                        {{-- <th>Cap nhat trang thai</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>#{{ $order->id }}</td>
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
                                            <td width="70px">
                                                <a href="{{ route('admin.orderdetail',['order_id' => $order->id]) }}" class="text-info"><i class=" fa fi-rs-eye"></i></a>
                                                <a href="#" class="text-danger" onclick="deleteConfirmationn({{ $order->id }})" style="margin-left: 20px;"><i class=" fi-rs-trash"></i></a>
                                                
                                            </td>
                                            <td>
                                                @if ($order->status == 'ordered')
                                                    <div class="dropdown">
                                                        <button class="btn btn-success dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                          Status
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                          <li><a class="dropdown-item" href="#" wire:click.prevent="updateOrderStatus({{ $order->id }},'delivered')">Đã giao hàng</a></li>
                                                          <li><a class="dropdown-item" href="#"wire:click.prevent="updateOrderStatus({{ $order->id }},'canceled')">Hủy đơn</a></li>
                                                        </ul>
                                                    </div>
                                                @else
                                                    <a href="">Done</a>
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

<div class="modal" id="deleteConfirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body pb-30 pt-30">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="pb-3">Bạn có chắc muốn xóa bản ghi này không ?</h4>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteConfirmation">Thoát</button>
                        <button type="button" class="btn btn-danger" onclick="deleteOrder()">Xóa</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function deleteConfirmationn(id) 
        {
            @this.set('order_id',id);
            $('#deleteConfirmation').modal('show');
        }

        function deleteOrder()
        {
            @this.call('deleteOrder');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush