<?php

namespace App\Http\Controllers;

use App\Models\tbl__category;
use Illuminate\Http\Request;

class Categorycontroller extends Controller
{
     public function ADDCATEGORY(Request $request)
    {
        $category = new tbl__category();
        $category->name = $request->name;

         if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/categories', $imageName);
            $category->img = 'categories/' . $imageName;
        }

         if ($request->hasFile('bimg')) {
            $bimage = $request->file('bimg');
            $bimageName = time() . '.' . $bimage->getClientOriginalExtension();
            $bimage->storeAs('public/categories', $bimageName);
            $category->bimg = 'categories/' . $bimageName;
        }

         $category->save();
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

     public function ShowProduct(Request $request)
    {
        $categories = tbl__category::all();
        return view('BackEnd.pages.Category.CategoryTable', compact('categories'));
    }

     public function destroy($id)
    {
        $categorys = tbl__category::findOrFail($id);
      //  $products = tbl_product::findOrFail($id);
        $categorys->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');    }

     public function edit($id)
    {
        $category = tbl__category::findOrFail($id);
        return view('BackEnd.pages.Category.edit', compact('category'));
    }

     public function update(Request $request, $id)
    {
        $category = tbl__category::findOrFail($id);

         $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bimg' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

         $category->name = $validatedData['name'];

         if ($request->hasFile('img')) {
             if ($category->img) {
                unlink(storage_path('app/public/' . $category->img));
            }
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/categories', $imageName);
            $category->img = 'categories/' . $imageName;
        }

         if ($request->hasFile('bimg')) {
             if ($category->bimg) {
                unlink(storage_path('app/public/' . $category->bimg));
            }
            $bimage = $request->file('bimg');
            $bimageName = time() . '.' . $bimage->getClientOriginalExtension();
            $bimage->storeAs('public/categories', $bimageName);
            $category->bimg = 'categories/' . $bimageName;
        }

         $category->save();

         return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
    public function apiAddCategory(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bimg' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = new tbl__category();
        $category->name = $validatedData['name'];

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '_img.' . $image->getClientOriginalExtension();
            $image->storeAs('public/categories', $imageName);
            $category->img = 'categories/' . $imageName;
        }

        if ($request->hasFile('bimg')) {
            $bimage = $request->file('bimg');
            $bimageName = time() . '_bimg.' . $bimage->getClientOriginalExtension();
            $bimage->storeAs('public/categories', $bimageName);
            $category->bimg = 'categories/' . $bimageName;
        }

        $category->save();

        return response()->json([
            'message' => 'Category added successfully.',
            'category' => $category,
        ], 201);
    }

    /**
     * Retrieve all categories via API.
     */
    public function apiShowCategories()
    {
        $categories = tbl__category::all();


                return response()->json($categories);

        // return response()->json([
        //     'categories' => $categories,
        // ], 200);

    }
//     public function apiIndex(): JsonResponse
// {
//     $products = tbl_product::all();
//     return response()->json($products);
// }
}
