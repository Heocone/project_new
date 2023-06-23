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
                    <span></span> Danh sách sản phẩm
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3>Danh sách sản phẩm</h3>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search product ................." aria-label="Recipient's username" aria-describedby="basic-addon2" wire:model="searchTerm">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button"><i class="fi fi-rs-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('admin.products.add') }}" class="btn btn-outline-success float-md-end">Thêm sản phẩm mới</a>
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
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Stock</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>Featured</th>
                                        <th>Sale</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>
                                                <img class="default-img" src="{{ asset('assets/imgs/products')}}/{{ $product->image }}" alt="{{ $product->name }}" width="60">
                                                <img class="default-img" src="{{ asset('assets/imgs/products')}}/{{ $product->image2 }}" alt="{{ $product->name }}" width="60">
                                                {{-- <img class="default-img" src="{{ asset('assets/imgs/shop')}}/{{ $product->image }}-1.jpg" alt="{{ $product->name }}" width="60">
                                                <img class="default-img" src="{{ asset('assets/imgs/shop')}}/{{ $product->image }}-2.jpg" alt="{{ $product->name }}" width="60"> --}}
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->stock_status }}</td>
                                            <td>{{ number_format($product->regular_price) }}</td>
                                            <td>{{ ($product->category->name) }}</td>
                                            <td>{{ $product->featured }}</td>
                                            <td>{{ $product->countsale }}</td>
                                            <td>{{ $product->created_at }}</td>
                                            <td width="70">
                                                <a href="{{ route('admin.products.edit',['product_id' => $product->id]) }}" class="text-info"><i class=" fa fi-rs-edit"></i></a>
                                                <a href="#" class="text-danger" onclick="deleteConfirmationn({{ $product->id }})" style="margin-left: 20px;"><i class=" fi-rs-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $products->links() }}
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
                        <button type="button" class="btn btn-danger" onclick="deleteproduct()">Xóa</button>
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
            @this.set('product_id',id);
            $('#deleteConfirmation').modal('show');
        }

        function deleteproduct()
        {
            @this.call('deleteProduct');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush