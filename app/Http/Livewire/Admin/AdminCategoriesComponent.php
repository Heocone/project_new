<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\WithPagination;

class AdminCategoriesComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $category_id;
    public function deleteCategory()
    {
        $category = Category::find($this->category_id);
        unlink('assets/imgs/categories/'.$category->image);
        $category->delete();
        session()->flash('message','Xóa danh mục thành công');
    }

    public function deleteSubcategory($id)
    {
        $scategory = Subcategory::find($id);
        unlink('assets/imgs/categories/'.$scategory->image);
        $scategory->delete();
        session()->flash('message', 'Xóa danh mục con thành công!');
    }
    public function render()
    {
        $categories = Category::orderBy('id', 'ASC')->paginate(6);
        return view('livewire.admin.admin-categories-component',[
            'categories' => $categories
        ]);
    }
}
