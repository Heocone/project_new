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
                    <span></span> Chỉnh sửa slide
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
                                    <h3>Chỉnh sửa slide</h3>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.sliders') }}" class="btn btn-outline-success float-md-end">Danh sách Sliders</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                            @endif
                            <form action="" wire:submit.prevent="updateSlide">
                                <div class="md-3 mt-3">
                                    <label for="toptitile" class="form-label"><h5>Tiêu đề trên</h5></label>
                                    <input type="text" name="toptitile" class="form-control" placeholder="Nhập tiêu đề trên" value="" wire:model="top_title">
                                    @error('top_title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="md-3 mt-3">
                                    <label for="title" class="form-label"><h5>Tiêu đề</h5></label>
                                    <input type="text" name="title" class="form-control" placeholder="Nhập tiêu đề" value="" wire:model="title">
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="md-3 mt-3">
                                    <label for="title" class="form-label"><h5>Phụ đề</h5></label>
                                    <input type="text" name="title" class="form-control" placeholder="Nhập phụ đề" value="" wire:model="sub_title">
                                    @error('sub_title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md-3 mt-3">
                                    <label for="title" class="form-label"><h5>Offer</h5></label>
                                    <input type="text" name="title" class="form-control" placeholder="Nhập offer" value="" wire:model="offer">
                                    @error('offer')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md-3 mt-3">
                                    <label for="title" class="form-label"><h5>Link</h5></label>
                                    <input type="text" name="title" class="form-control" placeholder="Nhập link" value="" wire:model="link">
                                    @error('link')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md-3 mt-3">
                                    <label for="title" class="form-label"><h5>Trạng thái</h5></label>
                                    <select class="form-select" wire:model="status">
                                        <option value="1">Họat động</option>
                                        <option value="2">Không hoạt động</option>
                                    </select>
                                    @error('status')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md-3 mt-3">
                                    <label for="image" class="form-label"><h5>Ảnh</h5></label>
                                    <input type="file" name="newimage" class="form-control" wire:model="newimage">
                                    @if ($newimage)
                                        <img src="{{ $newimage->temporaryUrl() }}" width="120" alt="">
                                    @else
                                    <img src="{{ asset('assets/imgs/slider') }}/{{ $image }}" width="120" alt="">
                                    @endif
                                    @error('image')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary float-end">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
