<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['description'];

    public function categories()
    {
      return $this->hasMany(Category::class, 'about_id');
    }
}
