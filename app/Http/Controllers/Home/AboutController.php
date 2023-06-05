<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use Intervention\Image\Facades\Image;
class AboutController extends Controller
{
    /**
     * View an about page
     */
    public function aboutPage(){
        $aboutPage = About::find(1);
        return view('admin.about_page.about_page_all', compact('aboutPage'));
    }

        /**
     * View an about page
     */
    public function homeAbout(){
        $aboutPage = About::find(1);
        return view('frontend.about_page', compact('aboutPage'));
    }
    

    /**
     * Update about page
     */
    public function updateAbout(Request $_request){
        $about_id = $_request->id;

        if ($_request->file('about_image')) {

            $image = $_request->file('about_image');
            $nameGen = hexdec(uniqid()) .'.'. $image->getClientOriginalExtension();
            $imageLocation = 'uploads/home_about/' . $nameGen; 

            Image::make($image)->resize(524,605)->save($imageLocation);

            About::findOrFail($about_id)->update([
                'title' => $_request->title,
                'short_title' => $_request->short_title,
                'short_description' => $_request->short_description,
                'long_description' => $_request->long_description,
                'about_image' => $imageLocation,
            ]);

            $notification = array(
                'message' => "About Page with Image  has been updated successfully",
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
    
        } else {
            About::findOrFail($about_id)->update([
                'title' => $_request->title,
                'short_title' => $_request->short_title,
                'short_description' => $_request->short_description,
                'long_description' => $_request->long_description,
            ]);

            $notification = array(
                'message' => "About Page without Image has been updated successfully",
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
    
        }
    }

}
