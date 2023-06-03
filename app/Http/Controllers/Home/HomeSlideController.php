<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlide;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
class HomeSlideController extends Controller
{
    /**
     * View a home slide
     */
    public function homeSlider(){
        $homeSlide = HomeSlide::find(1);
        return view('admin.home_slide.home_slide_all', compact('homeSlide'));
    }

    /**
     * Update slide
     */
    public function updateSlider(Request $_request){
        $slide_id = $_request->id;

        if ($_request->file('home_image')) {

            $image = $_request->file('home_image');
            $nameGen = hexdec(uniqid()) .'.'. $image->getClientOriginalExtension();
            $imageLocation = 'uploads/home_slide/' . $nameGen; 

            Image::make($image)->resize(636,852)->save($imageLocation);

            HomeSlide::findOrFail($slide_id)->update([
                'title' => $_request->title,
                'short_description' => $_request->short_description,
                'home_image' => $imageLocation,
                'video_url' => $_request->video_url,
            ]);

            $notification = array(
                'message' => "Home Slide with Image  has been updated successfully",
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
    
        } else {
            HomeSlide::findOrFail($slide_id)->update([
                'title' => $_request->title,
                'short_description' => $_request->short_description,
                'video_url' => $_request->video_url,
            ]);

            $notification = array(
                'message' => "Home Slide without Image has been updated successfully",
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
    
        }
    }
}
