<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class DetailsComponent extends Component
{
    public $slug;
    public $qty;
    public $satt=[];
    public $color;
    public $size;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->qty = 1;
    }
    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name,$this->qty, $product_price,$this->satt)->associate('\App\Models\Product');
        session()->flash('success_message','Them san pham vao gio hang thanh cong');
        return redirect()->route('cart.index');
    }

    public function increaseQuantity()
    {
        $this->qty++;
    }

    public function decreaseQuantity()
    {
        if($this->qty >1)
        {
            $this->qty--;
        }
    }
    public function render()
    {
        $categories = Category::orderBy('name','ASC')->get();
        $product = Product::where('slug',$this->slug)->first();
        $rproducts = Product::where('category_id',$product->category_id)->inRandomOrder()->limit(4)->get();
        $nproducts = Product::latest()->take(4)->get();
        if(Auth::check())
        {
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }
        return view('livewire.details-component',[
            'product'=>$product,
            'rproducts'=>$rproducts,
            'nproducts'=>$nproducts,
            'categories'=>$categories,
        ]);
    }
}
