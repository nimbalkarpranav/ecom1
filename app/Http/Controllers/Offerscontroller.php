<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\tbl__category;
use App\Models\tbl__offer;
use App\Models\tbl_product;
use Illuminate\Http\Request;

class Offerscontroller extends Controller
{
    public function Offers(Request $request)
    {
        $data = new tbl__offer();

        if ($request->hasFile('Img')) {
            $file = $request->file('Img');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/offers'), $filename);
            $data->Img = 'uploads/offers/' . $filename;
        }

        $data->Dis = $request->Dis;
        $data->percentage = $request->percentage;
        $data->save();

        return redirect()->back()->with('success', 'Offer saved successfully!');
    }


    public function showOffers()
{
    $products =  tbl_product::all(); // or paginate
    $categories = tbl__category::all();
    $sliders =  Slider::all();

    $offers = tbl__offer::latest()->take(2)->get(); // you can fetch more if needed

    return view('frantEnd.pages.home', compact('products', 'categories', 'offers','sliders'));
}

public function offersTable(Request $request){
    $offers=tbl__offer::all();
    return view('BackEnd.pages.offer.add');
}

}
