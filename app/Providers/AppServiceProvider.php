<?php

namespace App\Providers;

use App\Models\GameModel;
use Illuminate\Support\ServiceProvider;
use View;

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
        View::share('isOpenDocument', GameModel::where('id',config('app.game_id'))->value('is_open_document'));
    }
}
