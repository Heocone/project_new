<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\HomeSlider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddSliderComponent extends Component
{
    use WithFileUploads;
    public $top_title;
    public $title;
    public $sub_title;
    public $offer;
    public $link;
    public $status = 2;
    public $image;
    public function addSlide(){
        $this->validate([
            'top_title' => 'required',
            'title'=> 'required',
            'sub_title'=> 'required',
            'offer'=> 'required',
            'link'=> 'required',
            'status'=> 'required',
            'image'=> 'required|mimes:jpeg,png,jpg',
        ]);
        
        $slide = new HomeSlider();
        $slide->top_title = $this->top_title;
        $slide->title = $this->title;
        $slide->sub_title = $this->sub_title;
        $slide->offer = $this->offer;
        $slide->link = $this->link;
        $slide->status = $this->status;
        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('slider', $imageName);
        $slide->image = $imageName;
        $slide->save();
        session()->flash('message', 'Thêm Slider mới thành công!');
        return redirect()->route('admin.sliders');
    }
    public function render()
    {
        return view('livewire.admin.slider.admin-add-slider-component');
    }
}
