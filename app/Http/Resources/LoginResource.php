<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($request->user() && !session()->has('total_user_orders')) {
            session(['total_user_orders' => count($request->user()->orders)]);
        }

        return [
            'user' => new UserResource($request->user()),
            'total_orders' => session('total_user_orders'),
        ];
    }
}
