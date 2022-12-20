<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        // 
        $commonValue = '共通で使用したい値'; // ⭐️ 追加
        view()->share('commonValue', $commonValue); // ⭐️ 追加
    }
}
