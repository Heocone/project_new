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
                    <span></span> Danh sách thuộc tính
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
                                    <h3>Danh sách thuộc tính</h3>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.attribute.add') }}" class="btn btn-outline-success float-md-end">Thêm thuộc tính mới</a>
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
                                        <th>Tên thuộc tính</th>
                                        <th>Ngày tạo</th>
                                        <th>Công cụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pattributes as $pattribute)
                                        <tr>
                                            <td>{{ $pattribute->id }}</td>
                                            <td>{{ $pattribute->name }}</td>
                                            <td>{{ $pattribute->created_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.attribute.edit',['attribute_id' => $pattribute->id]) }}" class="text-info"><i class=" fa fi-rs-edit"></i></a>
                                                <a href="#" class="text-danger" onclick="deleteConfirmationn({{ $pattribute->id }})" style="margin-left: 20px;"><i class=" fi-rs-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $pattributes->links() }}
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
            @this.set('pattribute_id',id);
            $('#deleteConfirmation').modal('show');
        }

        function deleteCategory()
        {
            @this.call('deleteCategory');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush