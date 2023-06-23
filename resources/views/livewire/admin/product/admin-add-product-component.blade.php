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
                    <span></span> Thêm sản phẩm mới
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
                                    <h3>Thêm sản phẩm mới</h3>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.products') }}" class="btn btn-outline-success float-md-end">Danh sách sản phẩm</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                            @endif
                            <form action="" wire:submit.prevent="addProduct">
                                <div class="md-3 mt-3">
                                    <label for="name" class="form-label"><h5>Name</h5></label>
                                    @auth
                                    <input type="text" name="name" class="form-control" placeholder="Nhập tên danh mục" value="{{ Auth::user()->name }}" wire:model="name" wire:keyup="generateSlug">
                                    @endauth
                                    
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

                                <div class="md-3 mt-3" wire:ignore="true">
                                    <label for="short_description" class="form-label"><h5>Miêu tả sản phẩm</h5></label>
                                    <textarea name="short_description" id="short_description" class="form-control" placeholder="Nhập miêu tả sản phẩm" value="{{ old('short_description') }}" wire:model="short_description"></textarea>
                                    @error('short_description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md-3 mt-3"  wire:ignore="true">
                                    <label for="description" class="form-label"><h5>Miêu tả chi tiết sản phẩm</h5></label>
                                    <textarea name="description" id="description" class="form-control" placeholder="Nhập miêu tả chi tiết sản phẩm" value="{{ old('description') }}" wire:model="description"></textarea>
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md-3 mt-3">
                                    <label for="regular_price" class="form-label"><h5>Giá sản phẩm</h5></label>
                                    <input type="text" name="regular_price" class="form-control" placeholder="Nhập giá sản phẩm" value="{{ old('regular_price') }}" wire:model="regular_price">
                                    @error('regular_price')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md-3 mt-3">
                                    <label for="sale_price" class="form-label"><h5>Giá giảm</h5></label>
                                    <input type="text" name="sale_price" class="form-control" placeholder="Nhập giá giảm của sản phẩm" value="{{ old('sale_price') }}" wire:model="sale_price">
                                    @error('sale_price')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md-3 mt-3">
                                    <label for="sku" class="form-label"><h5>SKU</h5></label>
                                    <input type="text" name="sku" class="form-control" placeholder="Nhập SKU" value="{{ old('sku') }}" wire:model="sku">
                                    @error('sku')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md-3 mt-3">
                                    <label for="stock_status" class="form-label" ><h5>Thông tin tồn kho</h5></label>
                                    <select class="form-control" name="stock_status" id="" wire:model="stock_status">
                                        <option value="instock">InStock</option>
                                        <option value="outofstock">Out of Stock</option>
                                    </select>
                                    @error('stock_status')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md-3 mt-3">
                                    <label for="featured" class="form-label" value="0" ><h5>Featured</h5></label>
                                    <select class="form-control" name="featured" id="" wire:model="featured">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                    @error('featured')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md-3 mt-3">
                                    <label for="active" class="form-label" value="0" ><h5>Active</h5></label>
                                    <select class="form-control" name="active" id="" wire:model="active">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                    @error('active')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md-3 mt-3">
                                    <label for="quantity" class="form-label"><h5>Số lượng</h5></label>
                                    <input type="text" name="quantity" class="form-control" placeholder="Nhập số lượng sản phẩm" value="{{ old('quantity') }}" wire:model="quantity">
                                    @error('quantity')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md-3 mt-3">
                                    <label for="image" class="form-label"><h5>Ảnh</h5></label>
                                    <input type="file" name="image" class="form-control" wire:model="image">
                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" width="120" alt="">
                                    @endif
                                    @error('image')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md-3 mt-3">
                                    <label for="image2" class="form-label"><h5>Ảnh 2</h5></label>
                                    <input type="file" name="image2" class="form-control" wire:model="image2">
                                    @if ($image2)
                                        <img src="{{ $image2->temporaryUrl() }}" width="120" alt="">
                                    @endif
                                    @error('image2')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                
                                <div class="md-3 mt-3">
                                    <label for="image2" class="form-label"><h5>Ảnh 3</h5></label>
                                    <input type="file" name="image2" class="form-control" wire:model="images" multiple>
                                    @if ($images)
                                        @foreach ($images as $image)
                                            <img src="{{ $image->temporaryUrl() }}" width="120" alt="">
                                        @endforeach
                                    @endif
                                    @error('images')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md-3 mt-3">
                                    <label for="category_id" class="form-label"><h5>Danh mục sản phẩm</h5></label>
                                    <select class="form-control" name="category_id" id="" wire:model="category_id" wire:change="changeSubcategory">
                                        <option value="">Chọn danh mục</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach                                        
                                    </select>
                                    @error('category_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md-3 mt-3">
                                    <label for="category_id" class="form-label"><h5>Danh mục con</h5></label>
                                    <select class="form-control" name="category_id" id="" wire:model="scategory_id">
                                        <option value="0">Chọn danh mục</option>
                                        @foreach ($scategories as $scategory)
                                            <option value="{{ $scategory->id }}">{{ $scategory->name }}</option>
                                        @endforeach                                        
                                    </select>
                                    @error('scategory_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md-3 mt-3 form-group">
                                    <label for="category_id" class="form-label"><h5>Chọn thuộc tính sản phẩm</h5></label>
                                    <select class="form-control" name="category_id" id="" wire:model="attr">
                                        <option value="0">Chọn thuộc tính</option>
                                        @foreach($pattributes as $pattribute)
                                            <option value="{{ $pattribute->id }}">{{ $pattribute->name }}</option>
                                        @endforeach                                     
                                    </select>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-info" wire:click.prevent="add">Thêm</button>
                                    </div>
                                    @error('scategory_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                @foreach ($inputs as $key => $value)
                                <div class="form-group">
                                    <label class="col-md-4 control-label">
                                        {{ $pattributes->where('id',$attribute_arr[$key])->first()->name }}
                                    </label>
                                    <div class="col-md-3">
                                        <input type="text" placeholder="{{ $pattributes->where('id',$attribute_arr[$key])->first()->name }}" class="form-control input-md" wire:model="attribute_values.{{ $value }}"/>
                                        {{-- <input type="number" placeholder="Số lượng" wire:model="attrqty.{{ $value }}"> --}}
                                    </div>
                                    <div class="col-md-1">
                                    <button type="button" class="btn btn-danger btn-sm" wire:click.prevent="remove({{ $key }})">Xóa</button>
                                    </div>
                                </div>
                            @endforeach

                                <button type="submit" class="btn btn-primary float-end">Submit</button>
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
            tinymce.init({
                selector: '#short_description',
                setup:function(editor){
                    editor.on('Change', function(e){
                        tinyMCE.triggerSave();
                        var sd_data = $('#short_description').val();
                        @this.set('short_description',sd_data);
                    });
                }
            });

            tinymce.init({
                selector: '#description',
                setup:function(editor){
                    editor.on('Change', function(e){
                        tinyMCE.triggerSave();
                        var d_data = $('#description').val();
                        @this.set('description',d_data);
                    });
                }
            });
        });
    </script>
@endpush