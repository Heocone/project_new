<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class VnpayComponent extends Component
{
    public function deleteAll()
    {
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-icon-component','refreshComponent');
    }
    public function render()
    {
        $this->deleteAll();
        return view('livewire.thankyou-component');
    }
}
