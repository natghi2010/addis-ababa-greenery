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

        \Response::macro('success', function ($msg,$data = [], $code = 200) {
            return response()->json([
                'status' => 'success',
                'msg'=>$msg,
                'data' => $data
            ], $code);
        });

        \Response::macro('error', function ($message = '', $code = 500) {
            return response()->json([
                'status' => 'error',
                'message' => $message
            ], $code);
        });


    }
}
