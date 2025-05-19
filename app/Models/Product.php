<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [

        'name',
        'slug',
        'category_id',
        'sub_category_id',
        'collection_id',
        'image',
    ];

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }


        'name',
        'price',
        'uuid',
        'product_pdf',

    ];

    // public function productImages()
    // {
    //     return $this->hasMany(ProductImage::class);
    // }

}
