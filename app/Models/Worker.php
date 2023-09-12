<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

// use Spatie\Sluggable\HasSlug;
// use Spatie\Sluggable\SlugOptions;

class Worker extends Model
{
    use HasFactory, SoftDeletes, HasSlug;
    protected $guarded = ["id"];
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    protected $appends = ['path_image', 'path_file'];
    protected $fillable = [
        'professional_experience',
        'cover_image',
        'id_number',
        'address',
        'experience_year',
        'user_id',
        'profession_id',
        'CV'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'profession_id');
    }
    public function gallery()
    {
        return $this->hasOne(gallery::class, 'worker_id', 'id');
    }
    public function rate()
    {
        return $this->hasMany(Rate::class, 'worker_id');
    }
    public function getSlugOptions(): SlugOptions
    {
        //Build slug from name column and store slug column max length 255 and skip slug when deleted_at null

        return SlugOptions::create()
            ->generateSlugsFrom(['id_number'])
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(10)
            ->skipGenerateWhen(fn () => $this->deleted_at !== null);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function getPathImageAttribute($key)
    {
        // if (!Storage::disk('public')->exists($this->cover_image)) {
        //     return 'http://via.placeholder.com/80x80';
        // }

        // // return storage_path('app/' . $this->cover_image);
        // $filePath =  Storage::disk('public')->url($this->cover_image);

        if ($this->cover_image) {
            // return Storage::disk('public')->url($this->image_url);
            return url('app/public', [
                'image' => $this->cover_image,
            ]);
        }
        return 'http://via.placeholder.com/80x80';
    }

    public function getPathFileAttribute($key)
    {
        // $filePath = storage_path('app/' . $this->CV);
        // $filePath =  Storage::disk('public')->url($this->CV);

        // if (Storage::disk('local')->exists($filePath)) {
        //     //ترجع محتوى
        //     $fileContents = Storage::disk('local')->get($filePath);
        //     // Process the file contents as needed
        //     return $fileContents;
        // }


        if ($this->CV) {
            // return Storage::disk('public')->url($this->image_url);
            return url('app/public', [
                'file' => $this->CV,
            ]);
        }
        return 'http://via.placeholder.com/80x80';

        // return $filePath;
    }
}
