<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model implements HasMedia, TranslatableContract
{
    use HasFactory, InteractsWithMedia, Translatable;
    // protected $table = 'projects';

    protected $guarded = [];
    protected $dates = ['production_date' =>'datetime:Y-m-d'];

    // protected $dateFormat = 'U';

    public $translatedAttributes = ['description'];

    // public function setProductionDateAttribute($value) {
    //     $this->attributes['production_date'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    // }


    // protected $appends = ['url'];


    private $mediaCollection = 'photo';


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function aktivitete()
    {
        // return $this->belongsToMany(Aktivitete::class)->select(['id', 'name']);
        return $this->belongsToMany(Aktivitete::class);
    }

    public function photos()
    {
        return $this->morphMany(Media::class, 'model');
    }


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(272)
              ->height(320)
              ->sharpen(10);
    }

    // public function getUrlAttribute()
    // {
    //     $hasMedia = $this->getMedia('photo')->get();
    //     return  $hasMedia != null ?
    //         $hasMedia->getUrl() : "";
    // }
}
