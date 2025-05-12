<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsletterResource;
use App\Models\Newsletter;
use App\Rules\EmailAlias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Str;

class NewsletterController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(Newsletter::class)->withoutTrashed(),
                new EmailAlias(),
            ],
        ]);

        $newsletter = Newsletter::restoreOrCreate(
            ['email' => $request->email],
            ['token' => Str::uuid()->toString()]
        );

        return new NewsletterResource($newsletter);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $newsletter = Newsletter::where('email', Auth::user()->email)->first();

        if ($newsletter) {
            $newsletter->delete();
        }

        return $newsletter ? response()->noContent() : abort(404);
    }

    /**
     * Remove the specified resource from storage by token in URL.
     */
    public function destroyByToken($token)
    {
        if (!Str::isUuid($token)) {
            abort(400);
        }

        $newsletter = Newsletter::where('token', $token)->first();

        if ($newsletter) {
            $newsletter->delete();
        }

        return $newsletter ? response()->noContent() : abort(404);
    }
}
