<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function create()
    {
        return view("inventory.create");
    }

    public function show($id)
    {
        // $item = Item::find($id);
        // if (is_null($item)) {
        //     return abort(404);
        // }
        // return $item;
        // return view("inventory.show", compact("item"));

        return view("inventory.show", ["item" => Item::findOrFail($id)]);
    }

    public function index()
    {
        return view("inventory.index", ["items" => Item::paginate(7)]);
    }

    public function store(Request $request)
    {
        // dd($request->name);
        $request->validate([
            "name" => "required|min:3|max:50|unique:items,name",
            "price" => "required|numeric|gte:50",
            "stock" => "required|numeric|gt:3"
        ]);

        $items = new Item();
        $items->name = $request->name;
        $items->price = $request->price;
        $items->stock = $request->stock;

        $items->save();
        return redirect()->route("item.index");
    }

    public function destory($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->back();
    }


    public function edit($id)
    {
        return view("inventory.edit", ["item" => Item::findOrFail($id)]);
    }

    public function update($id, Request $request)
    {
        $item = Item::findOrFail($id);
        $id = $item->id;
        // dd($id);
        $request->validate([
            "name" => "required|min:3|max:50|unique:items,name,$id",
            "price" => "required|numeric|gte:50",
            "stock" => "required|numeric|gt:3"
        ]);


        $item->name = $request->name;
        $item->price = $request->price;
        $item->stock = $request->stock;

        $item->update();

        return redirect()->route("item.index");
    }
}
