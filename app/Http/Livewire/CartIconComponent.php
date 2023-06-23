<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Console\Migrations\RefreshCommand;

class CartIconComponent extends Component
{
    protected $listeners = ['refreshComponent'=>'$refresh'];
    public function destroyitem($id){
        Cart::remove($id);
        session()->flash('success_message','Xoa san pham thanh cong!');
        return redirect()->route('cart.index');
    }
    public function render()
    {
        return view('livewire.cart-icon-component');
    }
}
