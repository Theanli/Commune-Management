<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    //
    public function products()
    {
    	return $this->hasToMany(Product::class);
    }
}
