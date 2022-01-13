<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    // protected $table = 'categories';
    protected $guarded = [];
    // public $translationModel = 'App\Models\Category';
    public $translatedAttributes = ['description'];


    public function projects()
    {
      return $this->hasMany(Project::class, 'category_id');
    }
}
