<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowerController extends Controller
{
    public function followUnFollow(User $user)
    {
        abort_if($user->is(auth()->user()), 422, 'You cannot follow yourself.');

        $user->followers()->toggle(auth()->id());

        return response()->json([
            'followersCount' => $user->followers()->count(),
        ]);
    }
}
