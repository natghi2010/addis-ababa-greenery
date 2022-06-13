<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        //success response

        \Response::macro('success', function ($data = [], $code = 200) {
            return response()->json([
                'data' => $data
            ], $code);
        });

        \Response::macro('error', function ($message = '', $code = 500) {
            return response()->json([
                'message' => $message
            ], $code);
        });
    }
}
