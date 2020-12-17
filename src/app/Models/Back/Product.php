<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'jan_code',
        'category_id',
        'maker_id',
        'name',
        'price',
        'description',
        'is_published',
    ];
}
