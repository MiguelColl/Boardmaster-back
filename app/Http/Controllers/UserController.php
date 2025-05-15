<?php

namespace App\Http\Controllers;

use App\Enums\Gender;
use App\Http\Resources\CommentResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserResource;
use App\Models\ProductModel;
use App\Models\User;
use App\Rules\EmailAlias;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => [
                'sometimes',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class,
                new EmailAlias()
            ],
            'password' => ['sometimes', 'confirmed', Rules\Password::defaults()],
            'birthday' => ['sometimes', 'date'],
            'gender' => ['sometimes', 'integer', 'min:0', 'max:' . (count(Gender::cases()) - 1)],
        ]);

        $data = $request->only(['name', 'email', 'password', 'birthday', 'gender']);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        /** @var User $user */
        $user = Auth::user();

        $user->delete();

        return response()->noContent();
    }

    /**
     * Display a list of a user's favorite products.
     */
    public function indexFavorites()
    {
        /** @var User $user */
        $user = Auth::user();

        return $this->getAllFavorites($user);
    }

    /**
     * Store a new favorite product.
     */
    public function storeFavorite(Request $request, int $productId)
    {
        /** @var User $user */
        $user = Auth::user();

        $product = ProductModel::findOrFail($productId);
        $user->favorites()->syncWithoutDetaching($product->id);

        return $this->getAllFavorites($user);
    }

    /**
     * Remove the specified favorite product.
     */
    public function destroyFavorite(int $productId)
    {
        /** @var User $user */
        $user = Auth::user();

        $product = ProductModel::findOrFail($productId);
        $user->favorites()->detach($product->id);

        return $this->getAllFavorites($user);
    }

    private function getAllFavorites($user)
    {
        $user->load([
            'favorites' => [
                'variants' => [
                    'rate',
                    'stock',
                ],
                'comments',
            ]
        ]);

        return ProductResource::collection($user->favorites);
    }

    /**
     * Display a list of a user's orders.
     */
    public function indexOrders()
    {
        /** @var User $user */
        $user = Auth::user();

        $user->load('orders');

        return OrderResource::collection($user->orders);
    }

    /**
     * Display a list of a user's comments.
     */
    public function indexComments()
    {
        /** @var User $user */
        $user = Auth::user();

        $user->load('comments');

        return CommentResource::collection($user->comments);
    }
}
