<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        // $items = Item::all();
        // $items = Item::where("id", ">", 10)->where("price", ">", 700)->get();
        // $items = Item::when(true, function ($query) {
        //     $query->where("id", 6);
        // })->get();


        // $items = Item::when(true, function ($query) {
        //     $query->where("id", 5);
        // })->get();

        // dd($items);
        $items = Item::when(request()->has("keyword"), function ($query) {
            $keyword = request()->keyword;
            $query->where("name", "like", "%" . $keyword . "%");
        })->paginate(7)->withQueryString();
        // return $items;
        return view("inventory.index", compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("inventory.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {


        $items = new Item();
        $items->name = $request->name;
        $items->price = $request->price;
        $items->stock = $request->stock;

        $items->save();
        return redirect()->route("item.index")->with("info", "New Item Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view("inventory.show", compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        // return ($item);
        return view("inventory.edit", compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        // return $item;
        $item->name = $request->name;
        $item->price = $request->price;
        $item->stock = $request->stock;

        $item->update();

        return redirect()->route("item.index")->with("info", " Item Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        // return ($item);
        $item->delete();
        return redirect()->back()->with("info", " Item deleted");
    }
}
