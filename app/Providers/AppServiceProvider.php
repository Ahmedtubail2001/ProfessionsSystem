<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Rules\Base64image;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // add base64image in validator
        Validator::extend('base64image', function ($attribute, $value, $parameters, $validator) {
            $rule = new Base64image;
            return $rule->passes($attribute, $value);
        });

        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
        //
        Schema::defaultStringLength(200);
    }
}
