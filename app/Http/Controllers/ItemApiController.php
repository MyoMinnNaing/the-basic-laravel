<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::when(request()->has("keyword"), function ($query) {
            $keyword = request()->keyword;
            $query->where("name", "like", "%" . $keyword . "%");
        })->paginate(5)->withQueryString();

        // return response()->json($items);
        return ItemResource::collection($items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // $request->validate([
        //     "name" => "required|min:3|max:50|unique:items,name",
        //     "price" => "required|numeric|gte:50",
        //     "stock" => "required|numeric|gt:3"
        // ]);

        $validator = Validator::make($request->all(), [
            "name" => "required|min:3|max:50|unique:items,name",
            "price" => "required|numeric|gte:50",
            "stock" => "required|numeric|gt:3"
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        $item = new Item();
        $item->name = $request->name;
        $item->price = $request->price;
        $item->stock = $request->stock;

        $item->save();
        // return response()->json($item);
        return  new ItemResource($item);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::find($id);
        if (is_null($item)) {
            return response()->json(["message" => "not found"], 404);
        }
        // return response()->json($item);
        return new ItemResource($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "price" => "required",
            "stock" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        $item = Item::find($id);

        if (is_null($item)) {
            return response()->json(["message" => "not found"], 404);
        }

        // $item->update([
        //     "name" => $request->name,
        //     "price" => $request->price,
        //     "stock" => $request->stock,
        // ]);

        $item->name = $request->name;
        $item->price = $request->price;
        $item->stock = $request->stock;

        $item->update();
        return new ItemResource($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::find($id);
        if (is_null($item)) {
            return response()->json(["message" => "not found"], 404);
        }
        $item->delete();
        return response()->json([], 204);
    }
}
