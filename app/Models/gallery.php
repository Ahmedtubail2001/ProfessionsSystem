<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class gallery extends Model
{
    use HasFactory, HasSlug;
    protected $table = 'galleries';
    protected $primaryKey = 'id';
    protected $appends = ['check_active'];
    protected $guarded = ["id"];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['title', 'detail', 'visible', 'worker_id'];

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function worker()
    {
        $this->belongsTo(worker::class, 'worker_id', 'id');
    }

    // public function image()
    // {
    //     $this->hasMany(Image::class, 'imageable_id', 'id');
    // }

    public function getCheckActiveAttribute()
    {
        return $this->visible == "1" ?  'In-Active' : 'active';
    }

    public function scopeOwner($query, $id)
    {
        return $query->where('worker_id', $id);
    }

    public function getSlugOptions(): SlugOptions
    {
        //Build slug from name column and store slug column max length 255 and skip slug when deleted_at null

        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(255)
            ->skipGenerateWhen(fn () => $this->deleted_at !== null);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
