<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class properties extends Model
{
    use HasFactory;

    protected $fillable = [
           'property_name',
           'address',
           'state',
           'country',
           'price',
           'property_type',
           'bedrooms',
           'bathrooms',
           'year_built',
           'status',
           'listing_type',
           'image_path',
           'image_name',
           'description',
    ];
}
