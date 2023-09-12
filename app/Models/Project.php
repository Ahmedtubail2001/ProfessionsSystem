<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use NumberFormatter;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Project extends Model
{
    use HasFactory, HasSlug;
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];
    protected $fillable = ['name', 'description', 'time_first', 'notes', 'time_function', 'additional_file', 'value', 'funds', 'city_id', 'description_location', 'accept', 'user_id', 'worker_id', 'profession_id'];
    protected $appends = ['value_formatter', 'days_formatter'];

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function profession()
    {
        //fk ->pk
        return $this->belongsTo(Profession::class, 'profession_id', 'id');
    }
    public function worker()
    {
        return $this->belongsTo(Worker::class, 'worker_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeOwner($query, $id)
    {
        return $query->where('worker_id', $id);
    }

    public function offer()
    {
        // fk ->pk
        return $this->hasMany(Offer::class, 'project_id', 'id');
    }
    public function getValueFormatterAttribute()
    {
        $formatter = new NumberFormatter('en', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->value, 'USD');
    }
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['name', 'city_id'])
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(255)
            ->skipGenerateWhen(fn () => $this->delete_at != null);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    //accessor function
    //formate the value according state or currancy


    public function getDaysFormatterAttribute()
    {
        $datetime = Carbon::parse($this->time_function); // Date and time
        $formattedDays = $datetime->diffInDays(Carbon::now());
        return $formattedDays;
    }



    /**
     * Scope a query to only include users of a given type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $request)
    {
        if (isset($request['city'])) {
            $query->where('city_id', $request['city']);
        }
        if (isset($request['profession'])) {
            $query->where('profession_id', $request['profession']);
        }
        if (isset($request['speciality'])) {

            $query->whereHas('profession', function ($query) use ($request) {
                $query->where('specialtie_id', $request['speciality']);
            });
        }
        if (isset($request['min_value']) && isset($request['min_value'])) {
            $query->whereBetween('value', [$request['min_value'], $request['min_value']]);
        }
    }
    public static function values()
    {
        $value = [
            1 => 9,
            10 => 99,
            100 => 999,
            1000 => 9999,
            10000 => 99999,
            100000 => 999999,
            1000000 => 9999999
        ];
        return $value;
    }
}
