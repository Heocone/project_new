<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminEditCategoryComponent extends Component
{
    use WithFileUploads;
    public $category_id;
    public $name;
    public $slug;
    public $image;
    public $newimage;
    public $is_popular;
    public $scategory_id;
    public $scategory_slug;

    public function mount($category_id,$scategory_slug=null){
        if($scategory_slug)
        {
            $this->scategory_slug = $scategory_slug;
            $scategory = Subcategory::where('slug',$scategory_slug)->first();
            $this->scategory_id = $scategory->id;
            $this->category_id = $scategory->category_id;
            $this->image = $scategory->image;
            $this->name = $scategory->name;
            $this->slug = $scategory->slug;
        }
        else {
            $category = Category::find($category_id);
            $this->category_id = $category->id;
            $this->name = $category->name;
            $this->slug = $category->slug;
            $this->image = $category->image;
            $this->is_popular = $category->is_popular;
        }
    }

    public function generateSlug() 
    {
        $this->slug = Str::slug($this->name);
    }
    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);
    }

    public function updateCategory()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);
        if($this->scategory_id)
        {
            $scategory = Subcategory::find($this->scategory_id);
            $scategory->name = $this->name;
            $scategory->slug = $this->slug;
            if ($this->newimage) {
                unlink('assets/imgs/categories/'.$scategory->image);
                $imageName = Carbon::now()->timestamp.'.'.$this->newimage->extension();
                $this->newimage->storeAs('categories', $imageName);
                $scategory->image = $imageName;
            }
            $scategory->popular = $this->is_popular;
            $scategory->category_id = $this->category_id;
            $scategory->save();
        }else {
            $category = Category::find($this->category_id);
            $category->name = $this->name;
            $category->slug = $this->slug;
            if ($this->newimage) {
                unlink('assets/imgs/categories/'.$category->image);
                $imageName = Carbon::now()->timestamp.'.'.$this->newimage->extension();
                $this->newimage->storeAs('categories', $imageName);
                $category->image = $imageName;
            }
            $category->is_popular = $this->is_popular;
            $category->save();
        }
        session()->flash('message','Cập nhật danh mục thành công!');
        return redirect()->route('admin.categories');
    }
    public function render()
    {
        $categories = Category::all();
        $categories1 = Category::orderBy('id', 'ASC')->paginate(6);
        return view('livewire.admin.admin-edit-category-component',[
            'categories' => $categories,
            'categories1' => $categories1
        ]);
    }
}
