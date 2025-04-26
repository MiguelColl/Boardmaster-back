<?php

namespace App\Providers;

use App\Events\PaidOrder;
use App\Listeners\NotifyPaidOrder;
use App\Models\Order;
use App\Models\ProductModel;
use App\Models\User;
use App\Observers\OrderObserver;
use App\Observers\ProductModelObserver;
use App\Observers\UserObserver;
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

        Model::preventLazyLoading(true);

        // Formatting
        Date::serializeUsing(function ($date) {
            return $date->format(Carbon::ATOM);
        });

        // DB Tracing
        DB::listen(function ($query) {
            if (env('LOG_QUERY') == true) {
                \Log::channel('query')->info(Str::replaceArray('?', $query->bindings, $query->sql));
            }
        });

        // Observers
        User::observe(UserObserver::class);
        Order::observe(OrderObserver::class);
        ProductModel::observe(ProductModelObserver::class);

        // Listeners | Se detectan automáticamente en Laravel 11, si se añaden se duplican
        // Event::listen(PaidOrder::class, [NotifyPaidOrder::class, 'handle']);
    }
}
