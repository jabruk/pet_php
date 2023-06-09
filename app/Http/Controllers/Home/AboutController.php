<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\MultiImage;
use Illuminate\Support\Carbon;
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

    /**
     * Admin multi image
     */
    public function aboutMultiImage(){
        return view('admin.about_page.multi_image');
    }
    
    /**
     * Store Images
     */
    public function storeMultiImage(Request $request){
       $images =  $request->file('multi_image');

       foreach ( $images as $image) {
            $nameGen = hexdec(uniqid()) .'.'. $image->getClientOriginalExtension();
            $imageLocation = 'uploads/multi_image/' . $nameGen; 

            Image::make($image)->resize(220,220)->save($imageLocation);

            MultiImage::insert([
                'multi_image' => $imageLocation,
                'created_at' => Carbon::now(),
            ]);
        }
        $notification = array(
            'message' => "Multiple image has been inserted successfully",
            'alert-type' => 'success'
        );
       return redirect()->back()->with($notification);

    }

    /**
     * Show multi image
     */
    public function allMultiImage(){
        $allMultiImage = MultiImage::all();
        return view('admin.about_page.all_multi_image', compact('allMultiImage'));
    }

    /**
     * 
     * Edit Multi Emage
     */
    public function editMultiImage(Request $_request){
        if ($_request->file('multi_image')) {
            $multi_image_id = $_request->id;
            $image = $_request->file('multi_image');
            $nameGen = hexdec(uniqid()) .'.'. $image->getClientOriginalExtension();
            $imageLocation = 'uploads/home_about/' . $nameGen; 

            Image::make($image)->resize(220,220)->save($imageLocation);

            MultiImage::findOrFail($multi_image_id)->update([
                'multi_image' => $imageLocation,
            ]);

            $notification = array(
                'message' => "Multi Image has been updated successfully",
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
    
        }
    }

        /**
     * 
     * Delete Multi Emage
     */
    public function deleteMultiImage($id){
        $multi = MultiImage::findOrFail($id);
        unlink($multi->multi_image);
        MultiImage::findOrFail($id)->delete();

        $notification = array(
            'message' => "Multi Image has been deleted successfully",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }
}
