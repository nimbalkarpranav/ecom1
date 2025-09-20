<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\tbl__category;
use App\Models\tbl__offer;
use App\Models\tbl_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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


public function apiAddOffer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Dis' => 'required|string|max:255',
            'percentage' => 'required|numeric|min:0|max:100',
            'Img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error.',
                'errors' => $validator->errors(),
            ], 422);
        }

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

        return response()->json([
            'status' => true,
            'message' => 'Offer saved successfully!',
            'offer' => $data,
        ], 201);
    }




}
