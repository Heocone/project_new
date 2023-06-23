<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\HomeSlider;
use Livewire\Component;

class AdminHomeSliderComponent extends Component
{
    public $slide_id;
    public function deleteSlide(){
        $slide = HomeSlider::find($this->slide_id);
        unlink('assets/imgs/slider/'.$slide->image);
        $slide->delete();
        session()->flash('message', 'Xóa slide thành công');
    }
    public function render()
    {
        $slides = HomeSlider::orderBy('created_at','DESC')->get();
        return view('livewire.admin.slider.admin-home-slider-component',[
            'slides' => $slides
        ]);
    }
}
