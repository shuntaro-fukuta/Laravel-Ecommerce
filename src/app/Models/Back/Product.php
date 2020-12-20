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
        'image_url',
        'description',
        'is_published',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Back\Category');
    }

    public function maker()
    {
        return $this->belongsTo('App\Models\Back\Maker');
    }
}
