<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view("category.index", ["categories" => Category::paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // return $request;
        $category = new Category();
        $category->title = $request->title;
        $category->description = $request->description;

        $category->save();
        return redirect()->route("category.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view("category.show", ["category" => Category::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $category = Category::findOrFail($id);
        // return ($category);
        return view("category.edit", ["category" => Category::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $category = Category::findOrFail($id);
        $category->title = $request->title;
        $category->description = $request->description;

        $category->update();

        return redirect()->route("category.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back();
    }
}
