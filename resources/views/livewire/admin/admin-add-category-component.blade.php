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
                    <span></span> Thêm danh mục sản phẩm
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
                                    <h3>Thêm danh mục sản phẩm mới</h3>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.categories') }}" class="btn btn-outline-success float-md-end">Danh sách danh mục</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                            @endif
                            <form action="" wire:submit.prevent="storeCategory">
                                <div class="md-3 mt-3">
                                    <label for="name" class="form-label"><h5>Name</h5></label>
                                    <input type="text" name="name" class="form-control" placeholder="Nhập tên danh mục" value="" wire:model="name" wire:keyup="generateSlug">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="md-3 mt-3">
                                    <label for="slug" class="form-label"><h5>Slug</h5></label>
                                    <input type="text" name="slug" class="form-control" placeholder="Nhập tên danh mục" value="" wire:model="slug">
                                    @error('slug')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="md-3 mt-3">
                                    <label for="image" class="form-label"><h5>Ảnh</h5></label>
                                    <input type="file" name="image" class="form-control" wire:model="image">
                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" width="200">
                                    @endif
                                    @error('image')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="md-3 mt-3">
                                    <label for="is_popular" class="form-label"><h5>Popular</h5></label>
                                    <select class="form-control" name="is_popular" id="" wire:model="is_popular">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                    @error('is_popular')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="md-3 mt-3">
                                    <label for="category_id" class="form-label"><h5>Danh mục con</h5></label>
                                    <select class="form-control" name="category_id" id="" wire:model="category_id">
                                            <option value="">None</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary float-end">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
