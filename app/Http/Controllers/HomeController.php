<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function Slider(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'btn_text' => 'required|string',
            'btn_link' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Handle file upload
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('assets/uploads/slider'), $imageName);

        // Save to DB
        $slider = new Slider();
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->image = 'assets/uploads/slider/' . $imageName;
        $slider->btn_text = $request->btn_text;
        $slider->btn_link = $request->btn_link;
        $slider->save();

        return back()->with('success', 'Slider data saved successfully!');
    }




    public function index()
{
    $sliders = Slider::all();

    return view('frantEnd.pages.home', compact('sliders'));
}
public function index1()
{
    $sliders = Slider::all();

    return response()->json($sliders);

}

}
