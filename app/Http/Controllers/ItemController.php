<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ItemController extends Controller
{
    public function show(\App\Item $item) {
        return response()->json($item);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $item = new \App\Item;
        $item->name = $request->name;
        $item->save();

        return response()->json($item);
    }

    public function suggest($name) {
        $items = \DB::table('items')->select('name')->where('name', 'LIKE', '%' . $name . '%')->get();

        if(count($items) == 0) {
            return response()->json(['message' => 'No item matches.']);
        } 

        return response()->json($items);
    }
}
