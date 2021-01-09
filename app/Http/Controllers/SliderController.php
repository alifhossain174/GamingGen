<?php

namespace App\Http\Controllers;
use Image;
use App\Slider;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function sliderPage(){
        $sliders = Slider::orderBy('id','desc')->paginate(10);
        return view('backend.slider',compact('sliders'));
    }

    public function addNewSlider(Request $request){
        $image = null;

        if ($request->hasFile('image')){
            $get_image = $request->file('image');
            $image_name = str::random(5) . time() . '.' . $get_image->getClientOriginalExtension();
            Image::make($get_image)->save('slider_images/' . $image_name, 50);
            $image = "slider_images/" . $image_name;
        }

        Slider::insert([
            'image' => $image,
            'created_at' => Carbon::now()
        ]);

        Toastr::success('Slider has been Added', 'Success');
        return back();
    }

    public function deleteSlider($id){
        $data = Slider::where('id',$id)->first();
        if($data->image != null){
            if(file_exists(public_path($data->image))){
                unlink($data->image);
            }
        }
        Slider::where('id',$id)->delete();
        Toastr::error('Slider has been Deleted', 'Deleted');
        return back();
    }
}
