<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminAddCategoryComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $image;
    public $category_id;
    public $is_popular = 0;
    public function generateSlug(){
        $this->slug = Str::slug($this->name);
    }
    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => 'required|unique:categories',
            'image' => 'required'
        ]);
    }
    public function storeCategory()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories',
            'image' => 'required'
        ]);
        if($this->category_id)
        {
            $scategory = new Subcategory();
            $scategory->name = $this->name;
            $scategory->slug = $this->slug;
            $imagename = Carbon::now()->timestamp.'.'.$this->image->extension();
            $this->image->storeAs('categories',$imagename);
            $scategory->image = $imagename;
            $scategory->popular = $this->is_popular;
            $scategory->category_id = $this->category_id;
            $scategory->save();
        }
        else{
            $category = new Category();
            $category->name = $this->name;
            $category->slug = $this->slug;
            $imagename = Carbon::now()->timestamp.'.'.$this->image->extension();
            $this->image->storeAs('categories',$imagename);
            $category->image = $imagename;
            $category->is_popular = $this->is_popular;
            $category->save();
        }
        
        session()->flash('message','Thêm danh mục mới thành công!');
        return redirect()->route('admin.categories');
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-add-category-component',[
            'categories'=>$categories,
        ]);
    }
}
