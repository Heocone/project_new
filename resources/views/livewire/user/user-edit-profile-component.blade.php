<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Cập nhật thông cho tin tài khoản:{{ Auth::user()->name }}</h4>
                </div>
                <div class="panel-body">
                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                    @endif
                    <br>
                    <form action="" wire:submit.prevent="updateProfile">
                    <div class="col-md-4">
                        @if ($newimage)
                            <img src="{{ $newimage->temporaryUrl() }}" width="100%" alt="">
                        @elseif($image)
                            <img src="{{ asset('assets/imgs/profile') }}/{{ $image }}" width="50%" alt="">
                        @else   
                            <img src="{{ asset('assets/imgs/profile/avatar-7.jpg') }}" width="50%" alt="">
                        @endif
                        <input type="file" class="form-control" wire:model="newimage">
                    </div>
                    <div class="col-md-8">
                        <p><b>Họ tên:</b><input type="text" class="form-control" wire:model="name" ></p>
                        <p><b>Email::</b><input class="form-control" value="{{ $email }}" ></p>
                        <p><b>Số điện thoại:</b><input type="text" class="form-control" wire:model="mobile"></p>
                        <hr>
                        <p><b>Mô tả 1:</b><input type="text" class="form-control" wire:model="line1"></p>
                        <p><b>Mô tả 2:</b><input type="text" class="form-control" wire:model="line2"></p>
                        <p><b>Thành phố:</b><input type="text" class="form-control" wire:model="city"></p>
                        <p><b>Tỉnh:</b><input type="text" class="form-control" wire:model="province"></p>
                        <p><b>Đất nước:</b><input type="text" class="form-control" wire:model="country"></p>
                        <p><b>Zip code::</b><input type="text" class="form-control" wire:model="zipcode"></p>
                        <button type="submit" class="btn btn-info pull-right" name="">Cập nhật</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

