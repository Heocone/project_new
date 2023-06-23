<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{
    public $discount;
    public $subtotalAfterDiscount;
    public $taxAfterDiscount;
    public $totalAfterDiscount;
    public $couponCode;
    public function applyCouponCode()
    {
        $coupon = Coupon::where('code',$this->couponCode)->where('expiry_date','>=',Carbon::today())->where('cart_value','<=',Cart::instance('cart')->subtotal())->first();
        if(!$coupon)
        {
            session()->flash('coupon_message','Mã không tồn tại!');
            return;
        }
        else{
            session()->put('coupon',[
                'code' => $coupon->code,
                'type' => $coupon->type,
                'value' => $coupon->value,
                'cart_value' => $coupon->cart_value,
            ]);
        }
    }
    public function caculateDiscounts()
    {
        if(session()->has('coupon'))
        {
            if(session()->get('coupon')['type'] == 'fixed')
            {
                $this->discount = session()->get('coupon')['value'];
            }
            else
            {
                $this->discount = (Cart::instance('cart')->subtotal() * session()->get('coupon')['value'])/100;
            }
            $this->subtotalAfterDiscount = (int)(Cart::instance('cart')->subtotal()) - (int)($this->discount);
            $this->taxAfterDiscount = ($this->subtotalAfterDiscount * config('cart.tax'))/100;
            $this->totalAfterDiscount = $this->subtotalAfterDiscount + $this->taxAfterDiscount;
        }
    }

    public function setAmountForCheckout()
    {
        if(!Cart::instance('cart')->count() > 0)
        {
            session()->forget('checkout');
            return;
        }
        if (session()->has('coupon'))
        {
            session()->put('checkout',[
                'discount' => $this->discount,
                'subtotal' => $this->subtotalAfterDiscount,
                'tax' => $this->taxAfterDiscount,
                'total' => $this->totalAfterDiscount
            ]);
        }
        else
        {
            session()->put('checkout',[
                'discount' => 0,
                'subtotal' => Cart::instance('cart')->subtotal(),
                'tax' => Cart::instance('cart')->tax(),
                'total' => Cart::instance('cart')->total()
            ]);
        }
    }

    public function removeCoupon()
    {
        session()->forget('coupon');
    }

    public function increaseQuantity($rowId){
        // $products = Product::where('id','=',$rowId)->get('quantity');
        // dd($products);
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty+1;
        // if ($products->quantity ) {
            
        // }
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('cart-icon-component','refreshComponent');
    }
    public function decreaseQuantity($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty-1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('cart-icon-component','refreshComponent');
    }
    public function destroyitem($id){
        Cart::instance('cart')->remove($id);
        $this->emitTo('cart-icon-component','refreshComponent');
        session()->flash('success_message','Xoa san pham thanh cong!');
    }
    public function deleteAll(){
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-icon-component','refreshComponent');
        session()->flash('success_message','Xoa toan bo san pham thanh cong!');
    }

    public function checkout()
    {
        if(Auth::check())
        {
            return redirect()->route('checkout.index');
        }
        else
        {
            session()->flash('login_message','Vui lòng đăng nhập để thanh toán!');
            return redirect()->route('login');
        }
    }
    public function render()
    {
        if(session()->has('coupon'))
        {
            if(Cart::instance('cart')->subtotal() < session()->get('coupon')['cart_value'])
            {
                session()->forget('coupon');
            }
            else
            {
                $this->caculateDiscounts();
            }
        }
        $this->setAmountForCheckout();
        if(Auth::check())
        {
            Cart::instance('cart')->store(Auth::user()->email);
        }
        return view('livewire.cart-component');
    }
}
