<?php

namespace App\Models;

use App;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{	
	/*
	* Descriptions
	*/
    public function descriptions()
    {
        return $this->hasMany('App\Models\MediaDescription','media_id');
    }
    /*
    * 当前语言
    */
    public function description(){
        return $this->hasOne('App\Models\MediaDescription','media_id')->where('language',App::getLocale());
    }

    /*
    * Images
    */
    public function images()
    {
        return $this->hasMany('App\Models\MediaImage','media_id')->orderBy('sort_order','ASC');
    }

    /*
    * Categories
    */
    public function toCategories()
    {
        return $this->hasMany('App\Models\MediaToCategory','media_id');
    }
    /*
    * Categories
    */ 
    public function categories()
    {
        return $this->hasManyThrough('App\Models\MediaCategory','App\Models\MediaToCategory','media_id','id');
    }
}
