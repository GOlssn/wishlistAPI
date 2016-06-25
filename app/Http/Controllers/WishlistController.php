<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class WishlistController extends Controller {
    
    public function show(\App\Wishlist $wishlist) {
        $data = $this->formatJsonOutput($wishlist);
        return response()->json($data);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'event' => 'required',
            'event_date' => 'required|date'
        ]);

        $wishlist = new \App\Wishlist;
        $wishlist->event = $request->event;
        $wishlist->event_date = $request->event_date;
        $wishlist->save();

        foreach($request->items as $itemID) {
            $wishlist->items()->attach($itemID);
        }

        $data = $this->formatJsonOutput($wishlist);

        return response()->json($data);
    }

    private function formatJsonOutput(\App\Wishlist $wishlist) {
        $items = $wishlist->items;
        $itemsArray = array();

        foreach($items as $item) {
            $itemsArray[] = $item->name;
        }

        $data = [
            'event' => $wishlist->event,
            'event_date' => $wishlist->event_date,
            'items' => $itemsArray
        ];

        return $data;
    }

}
