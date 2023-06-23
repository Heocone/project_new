<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductComponent extends Component
{
    use WithPagination;
    public $searchTerm;
    public $product_id;
    public function deleteProduct(){
        $product = Product::find($this->product_id);
        if ($product->image)
        {
            unlink('assets/imgs/products/'.$product->image);
        }
        if ($product->image2)
        {
            unlink('assets/imgs/products2/'.$product->image2);
        }
        if($product->images)
        {
            $images = explode(',',$product->images);
            foreach($images as $image)
            {
                if($image)
                {
                    unlink('assets/imgs/products'.'/'.$image);            
                }
            }
        }
        $product->delete();
        session()->flash('message', 'Xóa sản phẩm thành công');
    }
    public function render()
    {
        $search = '%' . $this->searchTerm . '%';
        $products = Product::where('name','LIKE',$search)
        ->orWhere('stock_status','LIKE',$search)
        ->orWhere('regular_price','LIKE',$search)
        ->orWhere('sale_price','LIKE',$search)
        ->orderBy('id','DESC')->orderBy('created_at','DESC')->paginate(10);
        return view('livewire.admin.product.admin-product-component',[
            'products' => $products,
        ]);
    }
}
