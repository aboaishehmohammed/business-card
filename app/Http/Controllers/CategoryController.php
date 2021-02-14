<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'images' => 'required|array',
            "images.*" => "mimes:jpeg,png,jpg,svg"
        ]);


        $images = $request->images;
        $imageController = new ImageController();
        $images_id = [];
        for ($i = 0; $i < sizeof($images); $i++) {
            $images_id[$i] = $imageController->store($images[$i])->id;
        }
        $category = Category::create(['name' => $request->name,
        ]);

        $category->images()->sync($images_id);


        return $category->with('images')->get();
    }

    public function update(Request $request, $category)

    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'images' => 'required|array',
        ]);


        $category = Category::findorfail($category);

        if ($request->has('images')) {
            $imageController = new ImageController();
            $images = $request->images;
            $images_id = [];
            for ($i = 0; $i < sizeof($images); $i++) {
                if ($request->hasFile("images." . $i)) {
                    $request->validate([
                        'images.' . $i => "mimes:jpeg,png,jpg,svg",
                    ]);
                    $images_id[$i] = $imageController->store($images[$i])->id;
                } else {
                    $images_id[$i] = $request->images[$i];
                }
            }
            $category->update($request->all());
            $category->images()->sync($images_id);

        }

        $category->update(['name' => $request->name,
        ]);

        return $category->with('images')->findOrFail($category->id);
    }

    public function destroy($category)
    {
        Category::findorfail($category)->delete();
    }

    public function restore($category)
    {
        Category::onlyTrashed()->findOrFail($category)->restore();
    }

    public function ajaxAll()
    {

        return Category::with(['images'])->get();
    }

    public function ajaxOne($category)
    {
        return Category::with(['images'])->findorfail($category);
    }

    public function index()
    {
        return view("admin.pages.categories");
    }

    //
}
