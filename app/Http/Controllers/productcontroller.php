<?php

namespace App\Http\Controllers;

use App\Models\tbl__category;
use App\Models\tbl_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;


class productcontroller extends Controller
{

public function apiIndex(): JsonResponse
{
    $products = tbl_product::all();
    return response()->json($products);
}

public function apiShow($id): JsonResponse
{
    $product = tbl_product::find($id);
    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }
    return response()->json($product);
}

public function apiStore(Request $request): JsonResponse
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'category' => 'required|integer',
        'Dis' => 'nullable|string',
        'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $product = new tbl_product();
    $product->name = $validatedData['name'];
    $product->price = $validatedData['price'];
    $product->category = $validatedData['category'];
    $product->Dis = $validatedData['Dis'] ?? null;

    if ($request->hasFile('img')) {
        $img = $request->file('img');
        $imageName = time() . '.' . $img->getClientOriginalExtension();
        $img->storeAs('public/products', $imageName);
        $product->img = 'products/' . $imageName;
    }

    $product->save();

    return response()->json($product, 201);
}

public function apiUpdate(Request $request, $id): JsonResponse
{
    $product = tbl_product::find($id);
    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    $validatedData = $request->validate([
        'name' => 'sometimes|required|string|max:255',
        'price' => 'sometimes|required|numeric',
        'category' => 'sometimes|required|integer',
        'Dis' => 'nullable|string',
        'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if (isset($validatedData['name'])) {
        $product->name = $validatedData['name'];
    }
    if (isset($validatedData['price'])) {
        $product->price = $validatedData['price'];
    }
    if (isset($validatedData['category'])) {
        $product->category = $validatedData['category'];
    }
    if (array_key_exists('Dis', $validatedData)) {
        $product->Dis = $validatedData['Dis'];
    }

    if ($request->hasFile('img')) {
        $img = $request->file('img');
        $imageName = time() . '.' . $img->getClientOriginalExtension();
        $img->storeAs('public/products', $imageName);
        $product->img = 'products/' . $imageName;
    }

    $product->save();

    return response()->json($product);
}

public function apiDestroy($id): JsonResponse
{
    $product = tbl_product::find($id);
    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    $product->delete();

    return response()->json(['message' => 'Product deleted successfully']);
}





        public function ProductAdd(Request $request){
            $product = new tbl_product();

            $product->name = $request->name;
            $product->price = $request->price;

            if ($request->hasFile('img')) {
                $img = $request->file('img');
                $imageName = time() . '.' . $img->getClientOriginalExtension();
                $img->storeAs('public/products', $imageName);
                $product->img = 'products/' . $imageName;
            }

            $product->category = $request->category;
            $product->Dis = $request->Dis;
            $product->save();

            // ✅ Now fetch categories to send to the view
            $categories = tbl__category::all();

            return view('BackEnd.pages.poduct.addproduct', compact('categories'))
                   ->with('success', 'Product added successfully!');
        }
        public function create()
    {
        $categories = tbl__category::all();
        return view('BackEnd.pages.poduct.addproduct', compact('categories'));
    }



       public function ShowProduct1(Request $request){

        $categories=tbl__category::all();
         return  view('BackEnd.pages.poduct.productTable',compact('categories'));
       }
       public function ShowProduct(Request $request){

        $products=tbl_product::all();
        //  $products = tbl_product::join("tbl_cat","tbl_product.category","=","tbl_cat.id")
        // ->select("tbl_cat.name as category_name","tbl_product.*")->get();



         return  view('BackEnd.pages.poduct.productTable',compact('products'));
       }









       public function destroy($id)
       {
            $products = tbl_product::findOrFail($id);
            $products->delete();
            return view('BackEnd.pages.poduct.productTable',compact('products'));
       }


       public function update(Request $request, $id)
       {
           $product = tbl_product::findOrFail($id);
           if ($request->hasFile('img')) {
               $imgPath = $request->file('img')->store('products', 'public');
               $product->img = $imgPath;
           }

           $product->name = $request->name;
           $product->price = $request->price;
           $product->category = $request->category;
           $product->Dis = $request->Dis;
           $product->save();

           return redirect()->route('product.index')->with('success', 'Product updated successfully!');
       }


       public function edit($id)
       {
           $product = tbl_product::findOrFail($id);
           $categories=tbl__category::all();
           return view('BackEnd.pages.poduct.edit', compact('product','categories'));
       }




       //////////////////////////////////////////////////////



    public function showMenu()
    {
        $categories = tbl__category::all();
      //  $products = tbl_product::all();
        $products = tbl_product::join("tbl_cat","tbl_product.category","=","tbl_cat.id")
        ->select("tbl_cat.name as category_name","tbl_product.*")->get();


        return view('frantEnd.pages.menu', compact('categories', 'products'));
    }
    public function showMenu1()
    {
        $categories = tbl__category::all();
      //  $products = tbl_product::all();
        $products = tbl_product::join("tbl_cat","tbl_product.category"," =","tbl_cat.id")
        ->select("tbl_cat.name as category_name","tbl_product.*")->get();


        return view('frantEnd.pages.home', compact('categories', 'products'));
    }

    // public function showMenu()
    // {
    //     $categories = tbl__category::all();
    //     $products = tbl_product::with('category')->get();

    //     return view('frantEnd.pages.menu', compact('categories', 'products'));
    // }


}


