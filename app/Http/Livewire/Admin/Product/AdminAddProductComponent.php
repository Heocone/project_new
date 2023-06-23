<?php

namespace App\Http\Livewire\Admin\Product;

use Carbon\Carbon;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\AttributeValue;
use App\Models\ProductAttribute;

class AdminAddProductComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $regular_price;
    public $sale_price;
    public $sku;
    public $stock_status = 'instock';
    public $featured = 0;
    public $active = 1;
    public $quantity;
    public $image;
    public $image2;
    public $category_id;
    public $images;
    public $scategory_id;
    public $attr;
    public $attrqty;
    public $inputs = [];
    public $attribute_arr = [];
    public $attribute_values;
    public function generateSlug(){
        $this->slug = Str::slug($this->name);
    }
    public function updated($field) 
    {
        $this->validateOnly($field,[
            'name' => 'required',
            'slug' => 'required|unique:products',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'sku' => 'required',
            'stock_status' => 'required',
            'quantity' => 'required|numeric',
            'image' => 'required|mimes:jpeg,png,jpg',
            'image2' => 'required|mimes:jpeg,png,jpg',
            'category_id' => 'required',
        ]);
    }
    public function addProduct(){
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:products',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'sku' => 'required',
            // 'stock_status' => 'required',
            // 'featured' => 'required',
            // 'active' => 'required',
            'quantity' => 'required|numeric',
            'image' => 'required|mimes:jpeg,png,jpg',
            'image2' => 'required|mimes:jpeg,png,jpg',
            'category_id' => 'required',
        ]);
        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->SKU = $this->sku;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->active = $this->active;
        $product->quantity = $this->quantity;
        $imagename = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('products',$imagename);
        $product->image = $imagename;
        $imagename2 = Carbon::now()->timestamp.'.'.$this->image2->extension();
        $this->image2->storeAs('products2',$imagename2);
        $product->image2 = $imagename2;

        if($this->images)
        {
            $imagesname = '';  
            foreach($this->images as $key=>$image)
            {
                $imgName = Carbon::now()->timestamp . $key .'.' . $image->extension();
                $image->storeAs('products',$imgName);
                $imagesname = $imagesname . ',' . $imgName;
            } 
            $product->images = $imagesname;
        }
        $product->category_id = $this->category_id;
        if($this->scategory_id)
        {
            $product->subcategory_id = $this->scategory_id;
        }
        $product->save();
        foreach($this->attribute_values as $key => $attribute_value)
        {
            $avalues = explode(',',$attribute_value);
            foreach($avalues as $avalue)
            {
                $attr_value = new AttributeValue();
                $attr_value->product_attribute_id = $key;
                $attr_value->value = $avalue;
                $attr_value->product_id = $product->id;
                $attr_value->save();
            }
        }
        session()->flash('message','Thêm sản phẩm mới thành công!');
    }
    public function changeSubcategory()
    {
        $this->scategory_id = 0;
    }
    public function add()
    {
        if(!in_array($this->attr,$this->attribute_arr))
        {
            array_push($this->inputs,$this->attr);
            array_push($this->attribute_arr,$this->attr);
        }
    }
    public function remove($attr)
    {
        unset($this->inputs[$attr]);
    }
    public function render()
    {
        $pattributes = ProductAttribute::all();
        $categories = Category::orderBy('name','ASC')->get();
        $scategories = Subcategory::where('category_id',$this->category_id)->get();
        return view('livewire.admin.product.admin-add-product-component',[
            'categories'=>$categories,
            'scategories'=>$scategories,
            'pattributes'=>$pattributes,
        ]);
    }
}
