<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class SearchComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $pageSize = 12;
    public $orderBy = "Default Sorting";
    public $search_form;
    public $search_term;
    public $min_value = 0;
    public $max_value = 1000;

    public function mount()
    {
        $this->fill(request()->only('search_form'));
        $this->search_term = '%' . $this->search_form .'%';
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

    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name,1, $product_price)->associate('\App\Models\Product');
        $this->emitTo('cart-icon-component','refreshComponent');
        session()->flash('success_message','Them san pham vao gio hang thanh cong');
        // return redirect()->route('cart.index');
    }

    public function changePageSize($size){
        $this->pageSize = $size;
    }

    public function AllPageSize(){
        $this->pageSize = Product::count();
    }

    public function changeOrderBy($order)
    {
        $this->orderBy = $order;
    }
    public function render()
    {
        if ($this->orderBy == 'Thấp đến cao') 
        {
            $products = Product::where('active',1)->whereBetween('regular_price',[$this->min_value,$this->max_value])->where('name','like',$this->search_term)->orderBy('regular_price','ASC')->paginate($this->pageSize);
        } else if($this->orderBy == 'Cao đến thấp')
        {
            $products = Product::where('active',1)->whereBetween('regular_price',[$this->min_value,$this->max_value])->where('name','like',$this->search_term)->orderBy('regular_price','DESC')->paginate($this->pageSize);
        } else if($this->orderBy == 'Mới nhất')
        {
            $products = Product::where('active',1)->whereBetween('regular_price',[$this->min_value,$this->max_value])->where('name','like',$this->search_term)->orderBy('created_at','DESC')->paginate($this->pageSize);
        }else
        {
            $products = Product::where('active',1)->whereBetween('regular_price',[$this->min_value,$this->max_value])->where('name','like',$this->search_term)->paginate($this->pageSize);
        }
        $categories = Category::orderBy('name','ASC')->get();
        $productcount = Product::count();
        $nproducts = Product::latest()->take(3)->get();

        if(Auth::check())
        {
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }
        return view('livewire.search-component',[
            'products'=>$products,
            'productcount'=>$productcount,
            'categories' =>$categories,
            'searchvalue' =>$this->search_form,
            'nproducts'=>$nproducts,
        ]);
    }
}
