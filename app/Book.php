<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'paperback',
        'price'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
