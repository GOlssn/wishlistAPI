<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class WishlistController extends Controller {
    
    public function show(\App\Wishlist $wishlist) {

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

        return response()->json($data);
    }

}
