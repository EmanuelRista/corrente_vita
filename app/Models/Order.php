<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use CrudTrait;
    protected $fillable = ['user_id', 'total', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
