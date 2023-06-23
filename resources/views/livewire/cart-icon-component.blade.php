<div class="header-action-icon-2">
    <a class="mini-cart-icon" href="{{ route('cart.index') }}">
        <img alt="Surfside Media" src="{{ asset('assets/imgs/theme/icons/icon-cart.svg') }}">
        @if (Cart::instance('cart')->count() > 0)
        <span class="pro-count blue">{{ Cart::instance('cart')->count() }}</span>
        @endif
    </a>
        <div class="cart-dropdown-wrap cart-dropdown-hm2">
            @if (Cart::instance('cart')->count() > 0)
                <ul>
                    @foreach (Cart::instance('cart')->content() as $item)
                    <li>
                        <div class="shopping-cart-img">
                            <a href="{{ route('product.details',['slug'=>$item->model->slug]) }}"><img alt="{{ $item->model->name }}" src="{{ asset('assets/imgs/products')}}/{{ $item->model->image }}"></a>
                        </div>
                        <div class="shopping-cart-title">
                            <h4><a href="{{ route('product.details',['slug'=>$item->model->slug]) }}">{{ substr($item->model->name,0,20) }}...</a></h4>
                            @if ($item->model->sale_price > 0)
                            <h4><span>{{ $item->qty }} × </span>${{ number_format($item->model->sale_price) }}</h4>
                            @else
                            <h4><span>{{ $item->qty }} × </span>${{ number_format($item->model->regular_price) }}</h4>
                            @endif
                        </div>
                        <div class="shopping-cart-delete">
                            <a href="#" wire:click.prevent="destroyitem('{{ $item->rowId }}')"><i class="fi-rs-cross-small"></i></a>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <div class="shopping-cart-footer">
                    <div class="shopping-cart-total">
                        @php
                            $total = Cart::instance('cart')->total();
                        @endphp
                        <h4>Tổng tiền <span>{{ number_format($total) }} VNĐ</span></h4>
                    </div>
                    <div class="shopping-cart-button">
                        <a href="{{ route('cart.index') }}" class="outline">Giỏ hàng</a>
                        <a href="{{ route('checkout.index') }}">Thanh toán</a>
                    </div>
                </div>
                @else
                    <div class="shopping-cart-footer">
                        <div class="shopping-cart-total">
                            <h4>Giỏ hàng đang trống</h4>
                        </div>
                        <div class="shopping-cart-button">
                            <a href="{{ route('shop.index') }}" class="outline">Thêm sản phẩm</a>
                        </div>
                    </div>
            @endif
    </div>
</div>
