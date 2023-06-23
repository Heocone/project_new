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
                    <span></span> Chỉnh sửa thuộc tính sản phẩm
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
                                    <h3>Chỉnh sửa thuộc tính cho sản phẩm</h3>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.attributes') }}" class="btn btn-outline-success float-md-end">Danh sách thuộc tính</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                            @endif
                            <form class="form-horizontal" wire:submit.prevent="updateAttribute">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Tên thuộc tính</label>
                                    <div class="col-md-4">
                                        <input type="text" placeholder="Nhập tên thuộc tính" class="form-control input-md" wire:model="name" />
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                </div><div class="form-group">
                                    <label class="col-md-4 control-label"></label>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
