<?php

namespace App\Models;

use App;
use Illuminate\Database\Eloquent\Model;

class MediaCategory extends Model
{
    
    /*
     * Descriptions
     */
    public function descriptions()
    {
        return $this->hasMany('App\Models\MediaCategoryDescription', 'category_id');
    }
    /*
     * 当前语言
     */
    public function description()
    {
        return $this->hasOne('App\Models\MediaCategoryDescription', 'category_id')->where('language', App::getLocale());
    }
    /*
     * 子类
     */
    public function childrens()
    {
        return $this->hasMany('App\Models\MediaCategory', 'parent_id', 'id');
    }
}
