<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CategoryComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $pageSize = 12;
    public $orderBy = "Default Sorting";
    public $slug;
    public $min_value = 0;
    public $max_value = 2000000;
    public $scategory_slug;

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

    public function mount($slug,$scategory_slug=null)
    {
        $this->slug = $slug;
        $this->scategory_slug = $scategory_slug;
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
        $category_id = null;
        $category_name = '';
        $filter = '';
        if($this->scategory_slug)
        {
            $scategory = Subcategory::where('slug',$this->scategory_slug)->first();
            $category_id = $scategory->id;
            $category_name = $scategory->name;
            $filter = "sub";
        }else{
            $category = Category::where('slug', $this->slug)->first();
            $category_id = $category->id;
            $category_name = $category->name;
            $filter = "";
        }
        
        if ($this->orderBy == 'Thấp đến cao') 
        {
            $products = Product::where('active',1)->whereBetween('regular_price',[$this->min_value,$this->max_value])->where($filter.'category_id',$category_id)->orderBy('regular_price','ASC')->paginate($this->pageSize);
        } else if($this->orderBy == 'Cao đến thấp')
        {
            $products = Product::where('active',1)->whereBetween('regular_price',[$this->min_value,$this->max_value])->where($filter.'category_id',$category_id)->orderBy('regular_price','DESC')->paginate($this->pageSize);
        } else if($this->orderBy == 'Mới nhất')
        {
            $products = Product::where('active',1)->whereBetween('regular_price',[$this->min_value,$this->max_value])->where($filter.'category_id',$category_id)->orderBy('created_at','DESC')->paginate($this->pageSize);
        }else
        {
            $products = Product::where('active',1)->whereBetween('regular_price',[$this->min_value,$this->max_value])->where($filter.'category_id',$category_id)->paginate($this->pageSize);
        }
        $categories = Category::orderBy('name','ASC')->get();
        $productcount = Product::count();
        $nproducts = Product::latest()->take(3)->get();
        if(Auth::check())
        {
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }
        return view('livewire.category-component',[
            'products'=>$products,
            'productcount'=>$productcount,
            'categories' =>$categories,
            'category_name'=>$category_name,
            'nproducts' =>$nproducts,
        ]);
    }
}
