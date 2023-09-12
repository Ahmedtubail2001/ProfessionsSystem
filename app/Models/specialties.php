<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Models\Profession;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class specialties extends Model
{
    use SoftDeletes, HasSlug, HasFactory;
    // protected $appends = ['activity_status'];
    public function getActivityAttribute()
    {
        return $this->active ? 'Active' : 'In Active';
    }

    protected $table = 'specialties';
    protected $primaryKey = 'id';

    protected $guarded = ["id"];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['title', 'active'];
    protected $appends = ['StatusSpecialties'];

    public function profession()
    {
        //PK->hasMany(FK table, FK Column , Pk);
        return $this->hasMany(Profession::class, 'specialtie_id', 'id');
    }



    public function getStatusSpecialtiesAttribute()
    {

        return $this->active == 1 ? 'show' : 'hidden';
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

    /**
     * @return mixed
     */
    public function getAppends()
    {
        return $this->appends;
    }

    /**
     * @param mixed $appends 
     * @return self
     */
    public function setAppends($appends): self
    {
        $this->appends = $appends;
        return $this;
    }
}
