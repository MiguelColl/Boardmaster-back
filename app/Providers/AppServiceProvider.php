<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        Date::serializeUsing(function ($date) {
            return $date->format(Carbon::ATOM);
        });

        Model::preventLazyLoading(true);

        DB::listen(function ($query) {
            if (env('LOG_QUERY') == true) {
                \Log::channel('query')->info(Str::replaceArray('?', $query->bindings, $query->sql));
            }
        });
    }
}
