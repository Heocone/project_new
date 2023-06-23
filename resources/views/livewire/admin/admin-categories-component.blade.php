<div>
    <style>
        nav svg{
            height: 20px;
        }
        nav .hidden{
            display:block;
        }
        .sclist{
            list-style: none;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>
                    <span></span> Danh mục sản phẩm
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
                                    <h3>Danh mục sản phẩm</h3>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.category.addd') }}" class="btn btn-outline-success float-md-end">Thêm danh mục mới</a>
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
                                        <th>Slug</th>
                                        <th>Popular</th>
                                        <th>Subcategory</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td><img src="{{ asset('assets/imgs/categories') }}/{{ $category->image }}" alt="" width="100"></td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->slug }}</td>
                                            <td>{{ $category->is_popular == 1 ? 'Yes':'No' }}</td>
                                            <td>
                                                <ul class="sclist">
                                                    @foreach ($category->subCategories as $scategory)
                                                        <li><i class=" fi fi-rs-caret-right"></i>{{ $scategory->name }}<a href="{{ route('admin.category.edit',['category_id'=>$category->slug,'scategory_slug'=>$scategory->slug]) }}" >
                                                            <i class="fi fi-rs-edit"></i>
                                                            </a>
                                                            <a href="#" onclick="confirm('Are you sure about that?') || event.stopImmediatePropagation()" wire:click.prevent="deleteSubcategory({{ $scategory->id }})" ><i class="fi fi-rs-delete text-danger"></i></a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.category.edit',['category_id' => $category->id]) }}" class="text-info"><i class=" fa fi-rs-edit"></i></a>
                                                <a href="#" class="text-danger" onclick="deleteConfirmationn({{ $category->id }})" style="margin-left: 20px;"><i class=" fi-rs-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $categories->links() }}
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