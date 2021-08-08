<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends User
{
    use HasFactory;
    protected $table= 'users';//overiding it will fetch data from that table

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
