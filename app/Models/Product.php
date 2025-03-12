<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CrudTrait;
    protected $fillable = ['title', 'description', 'price', 'stock', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
