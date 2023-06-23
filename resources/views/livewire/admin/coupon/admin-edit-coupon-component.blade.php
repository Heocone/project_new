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
                    <span></span> Chỉnh sửa danh mục
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
                                    <h3>Chỉnh sửa danh mục</h3>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.coupons') }}" class="btn btn-outline-success float-md-end">Danh sách mã</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                            @endif
                            <form class="form-horizontal" wire:submit.prevent="updateCoupon">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Nhập mã</label>
                                    <div class="col-md-4">
                                        <input type="text" placeholder="Nhập mã" class="form-control input-md" wire:model="code"/>
                                        @error('code')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Kiểu</label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="" id="" wire:model="type">
                                            <option value="">Tùy chọn</option>
                                            <option value="fixed">Dollar $</option>
                                            <option value="percent">Phần trăm %</option>
                                        </select>
                                        @error('type')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Giá trị mã:</label>
                                    <div class="col-md-4">
                                        <input type="text" placeholder="Giá trị mã" class="form-control input-md" wire:model="value" >
                                        @error('value')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Giá trị của giỏ hàng:</label>
                                    <div class="col-md-4">
                                        <input type="text" placeholder="Giá trị của giỏ hàng" class="form-control input-md" wire:model="cart_value" >
                                        @error('cart_value')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Ngày hết hạn:</label>
                                    <div class="col-md-4" wire:ignore>
                                        <input type="datetime-local" id="expiry-date" placeholder="Ngày hết hạn" class="form-control input-md" wire:model="expiry_date" >
                                        @error('expiry_date')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label"></label>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    </div>
                                </div>
    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
@push('scripts')
    <script>
        $(function(){
            $('#expiry-date').datetimepicker({
                format: 'Y-MM-DD'
            })
            .on('dp.change',function(ev){
                var data = $('#expiry-date').val();
                @this.set('expiry_date',data);
            });
        });
    </script>
@endpush
