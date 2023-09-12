<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Profession extends Model
{
    use HasSlug, HasFactory, SoftDeletes;
    protected $primaryKey = 'id';
    // protected $guarded = ["id"];
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];
    protected $appends = ['Activity'];

    public function getActivityAttribute()
    {
        return $this->allow_register ? 'Active' : 'In Active';
    }
    protected $fillable = ['title', 'description', 'allow_register', 'specialtie_id'];

    public function specialty()
    {
        return $this->belongsTo(specialties::class, 'specialtie_id', 'id');
    }

    public function worker()
    {
        $this->hasMany(Worker::class, 'profession_id', 'id');
    }

    public function getSlugOptions(): SlugOptions
    {
        $Sl_OP =  SlugOptions::create()
            ->generateSlugsFrom(['title'])
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(255)
            ->skipGenerateWhen(fn () => $this->deleted_at !== null);
        return $Sl_OP;
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
