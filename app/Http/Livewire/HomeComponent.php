<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\HomeSlider;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class HomeComponent extends Component
{
    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name,1, $product_price)->associate('\App\Models\Product');
        $this->emitTo('cart-icon-component','refreshComponent');
        session()->flash('success_message','Them san pham vao gio hang thanh cong');
        // return redirect()->route('cart.index');
    }
    public function addToWishList($product_id, $product_name, $product_price)
    {
        Cart::instance('wishlist')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        $this->emitTo('wishlist-icon-component','refreshComponentt');
    }

    public function removeFromWishlist($product_id){
        foreach (Cart::instance('wishlist')->content() as $witem) 
        {
            if ($witem->id == $product_id) {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wishlist-icon-component','refreshComponentt');
                return;
            }
        }
    }
    public function render()
    {
        $slides = HomeSlider::where('status',1)->get();
        $lproducts = Product::orderBy('created_at','DESC')->get()->take(8);
        $fproducts = Product::where('featured',1)->inrandomOrder()->get()->take(8);
        $pcategories = Category::where('is_popular',1)->inrandomOrder()->get()->take(8);
        $nproducts = Product::where('sale_price','>',1)->inrandomOrder()->take(8)->get();
        $pproducts = Product::where('countsale','>',100)->inrandomOrder()->take(8)->get();
        if(Auth::check())
        {
            Cart::instance('cart')->restore(Auth::user()->email);
            Cart::instance('wishlist')->restore(Auth::user()->email);
        }
        return view('livewire.home-component',[
            'slides'=>$slides,
            'lproducts'=>$lproducts,
            'fproducts' => $fproducts,
            'pcategories' => $pcategories,
            'nproducts'=>$nproducts,
            'pproducts'=>$pproducts,
        ]);
    }
}
