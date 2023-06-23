<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>
                    <span></span> Danh mục sản phẩm
                </div>
            </div>
        </div>
    </main>
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
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">    
                  <div class="icon-stat">    
                    <div class="row">
                      <div class="col-xs-8 text-left">
                        <span class="icon-stat-label">Total Revenue</span>
                        <span class="icon-stat-value">$ {{ $totalRevenue }}</span>
                      </div>   
                      <div class="col-xs-4 text-center">
                        <i class="fi fi-rs-dollar icon-stat-visual bg-primary"></i>
                      </div>
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
                        <span class="icon-stat-label">Total Sales</span>
                        <span class="icon-stat-value">{{ $totalSales }}</span>
                      </div>    
                      <div class="col-xs-4 text-center">
                        <i class="fi fi-rs-bank icon-stat-visual bg-secondary"></i>
                      </div>
                    </div>    
                    <div class="icon-stat-footer">
                      <i class="fi fi-rs-alarm-clock"></i> Updated Now
                    </div>   
                  </div>
                </div>
                <div class="col-md-3 col-sm-6">    
                  <div class="icon-stat">    
                    <div class="row">
                      <div class="col-xs-8 text-left">
                        <span class="icon-stat-label">Today Revenue</span>
                        <span class="icon-stat-value">${{ $todayRevenue }}</span>
                      </div>    
                      <div class="col-xs-4 text-center">
                        <i class="fi fi-rs-dollar icon-stat-visual bg-primary"></i>
                      </div>
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
                        <span class="icon-stat-label">Today Sales</span>
                        <span class="icon-stat-value">{{ $todaySlades }}</span>
                      </div>    
                      <div class="col-xs-4 text-center">
                        <i class="fi fi-rs-bank icon-stat-visual bg-secondary"></i>
                      </div>
                    </div>    
                    <div class="icon-stat-footer">
                      <i class="fi fi-rs-clock"></i> Updated Now
                    </div>    
                  </div>    
                </div>    
              </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <br>
                        <div class="panel-heading">
                            <h3>Đơn hàng mới nhất</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Đơn hàng phụ</th>
                                        <th>Giảm giá</th>
                                        <th>Thuế</th>
                                        <th>Đơn hàng tổng</th>
                                        <th>Họ, tên đệm</th>
                                        <th>Tên</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th>Zipcode</th>
                                        <th>Status</th>
                                        <th>Ngày tạo</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>${{ $order->subtotal }}</td>
                                        <td>${{ $order->discount }}</td>
                                        <td>${{ $order->tax }}</td>
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
                                        </td>
                                        <td>{{ $order->created_at }}</td>
                                        <td><a href="{{ route('admin.orderdetail',['order_id' => $order->id]) }}" class="btn btn-info btn-sm">Details</a></td>
                                        
                                    </tr>
                                    @endforeach 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>

<div class="modal" id="deleteConfirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body pb-30 pt-30">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="pb-3">Bạn có chắc muốn xóa bản ghi này không ?</h4>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteConfirmation">Thoát</button>
                        <button type="button" class="btn btn-danger" onclick="deleteCategory()">Xóa</button>
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
            @this.set('category_id',id);
            $('#deleteConfirmation').modal('show');
        }

        function deleteCategory()
        {
            @this.call('deleteCategory');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush