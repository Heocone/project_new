<div class="search-style-1">
    <form action="{{ route('product.search') }}">                                
        <input type="text" name="search_form" placeholder="Tìm kiếm sản phẩm ..." value="{{ $search_form }}" maxlength="100" >
        {{-- <button type="submit" class="rounded-circle"></button> --}}
    </form>
    
</div>