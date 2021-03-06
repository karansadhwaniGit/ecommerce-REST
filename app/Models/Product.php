<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const AVAILABLE_PRODUCT =1;
    const UNAVAILABLE_PRODUCT=0;
    protected $filllable=[
        'name',
        'description',
        'quantity',
        'status',//available ,unavailable
        'image',
        'seller_id',
    ];

    public function isAvaialble()
    {
        return $this->status == Product::AVAILABLE_PRODUCT;
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
