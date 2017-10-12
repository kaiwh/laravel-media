<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaToCategory extends Model
{
    public $timestamps = false;
    public $primaryKey = 'category_id';

    // Categories
    public function category()
    {
        return $this->belongsTo('App\Models\MediaCategory','category_id');
    }
}
