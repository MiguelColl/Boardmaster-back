<?php

namespace App\Listeners;

use App\Models\Cart;
use App\Models\User;
use App\Services\CartService;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;

class LoginListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        /** @var User $user */
        $user = $event->user;
        $user->update([
            'login_at' => Carbon::now(),
        ]);
        \Log::channel('sentry')->info("[LOGIN] User $user->id: $user->name logged.");

        if (session()->has('cart_id')) {
            $guestCart = Cart::with('lines')->find(session('cart_id'));

            if ($user->cart) {
                foreach ($guestCart->lines as $guestLine) {
                    if ($userCartLine = CartService::checkLine($user->cart->id, $guestLine->product_variant_id)) {
                        CartService::updateProduct($userCartLine, $guestLine->units + $userCartLine->units);
                        $guestLine->delete();
                    } else {
                        $guestLine->update([
                            'cart_id' => $user->cart->id,
                        ]);
                    }
                }

                $guestCart->update([
                    'active' => false,
                ]);
            } else {
                $guestCart->update([
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
