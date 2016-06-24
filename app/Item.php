<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function wishlists() {
        return $this->belongsToMany(App\Wishlist)->withTimestamps();
    }
}
