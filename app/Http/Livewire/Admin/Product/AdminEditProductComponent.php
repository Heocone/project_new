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

class AdminEditProductComponent extends Component
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
    public $product_id;
    public $newimage;
    public $newimage2;
    public $images;
    public $newimages;
    public $scategory_id;
    public $attr;
    public $inputs = [];
    public $attribute_arr = [];
    public $attribute_values = [];
    public function updated($fields) 
    {
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'numeric',
            'sku' => 'required',
            'stock_status' => 'required',
            'quantity' => 'required|numeric',
            'category_id' => 'required',
        ]);
        if($this->newimage)
        {
            $this->validateOnly($fields,[
                'newimage' => 'required|mimes:jpeg,png,jpg',
            ]);
        }
    }

    public function mount($product_id) {
        $product = Product::find($product_id);
        $this->product_id = $product->id;
        $this->name = $product->name; 
        $this->slug = $product->slug; 
        $this->short_description = $product->short_description; 
        $this->description = $product->description; 
        $this->regular_price = $product->regular_price; 
        $this->sale_price = $product->sale_price; 
        $this->sku = $product->SKU; 
        $this->stock_status = $product->stock_status; 
        $this->featured = $product->featured; 
        $this->active = $product->active; 
        $this->quantity = $product->quantity; 
        $this->image = $product->image; 
        $this->image2 = $product->image2; 
        $this->images= explode(",",$product->images);
        $this->category_id = $product->category_id; 
        $this->scategory_id = $product->scategory_id;
        $this->inputs = $product->attributeValues->where('product_id',$product->id)->unique('product_attribute_id')->pluck('product_attribute_id');
        $this->attribute_arr = $product->attributeValues->where('product_id',$product->id)->unique('product_attribute_id')->pluck('product_attribute_id');

        foreach($this->attribute_arr as $a_arr)
        {
            $allAttributeValue = AttributeValue::where('product_id',$product->id)->where('product_attribute_id',$a_arr)->get()->pluck('value');
            $valueString = '';
            foreach($allAttributeValue as $value) 
            {
                $valueString = $valueString . $value . ',';
            }
            $this->attribute_values[$a_arr] = rtrim($valueString, ",");
        }
    }
    public function generateSlug(){
        $this->slug = Str::slug($this->name);
    }

    public function updateProduct(){
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'sku' => 'required',
            // 'stock_status' => 'required',
            // 'featured' => 'required',
            // 'active' => 'required',
            'quantity' => 'required|numeric',
            'image' => 'required',
            'image2' => 'required',
            'category_id' => 'required',
        ]);
        if($this->newimage)
        {
            $this->validateOnly([
                'newimage' => 'required|mimes:jpeg,png,jpg',
            ]);
        }
        $product = Product::find($this->product_id);
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
        if($this->newimage)
        {
            unlink('assets/imgs/products/'.$product->image);
            $imagename = Carbon::now()->timestamp.'.'.$this->newimage->extension();
            $this->newimage->storeAs('products',$imagename);
            $product->image = $imagename;
        }
        if ($this->newimage2) {
            unlink('assets/imgs/products2/'.$product->image2);
            $imagename2 = Carbon::now()->timestamp.'.'.$this->newimage2->extension();
            $this->newimage2->storeAs('products2',$imagename2);
            $product->image2 = $imagename2;
        }
        if($this->newimages)
        {
            if($product->images)
            {
                $images = explode(",",$product->images);
                foreach($images as $image)
                {
                    if($image)
                    {
                        unlink('assets/imgs/products'.'/'.$image);            
                    }
                }
            }
            $imagesname = '';
            foreach($this->newimages as $key=>$image)
            {
                $imgName = Carbon::now()->timestamp. $key . '_' . $image->extension();
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
        AttributeValue::where('product_id', $product->id)->delete();
        foreach($this->attribute_values as $key => $attribute_value)
        {
            $avalues = explode(",",$attribute_value);
            foreach($avalues as $avalue)
            {
                $attr_value = new AttributeValue();
                $attr_value->product_attribute_id = $key;
                $attr_value->value = $avalue;
                $attr_value->product_id = $product->id;
                $attr_value->save();
            }
        }
        session()->flash('message','Cập nhật sản phẩm thành công!');
    }
    public function add()
    {
        if(!$this->attribute_arr->contains($this->attr))
        {
            $this->inputs->push($this->attr);
            $this->attribute_arr->push($this->attr);
        }
    }

    public function remove($attr)
    {
        unset($this->inputs[$attr]);
    }
    public function changeSubcategory()
    {
        $this->scategory_id = 0;
    }
    public function render()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $scategories = Subcategory::where('category_id',$this->category_id)->get();
        $pattributes = ProductAttribute::all();
        return view('livewire.admin.product.admin-edit-product-component',[
            'categories' => $categories,
            'scategories'=>$scategories,
            'pattributes' =>$pattributes,
        ]);
    }
}
