<?php

namespace App\Http\Controllers;

use App\Models\User;

class PublcProfileController extends Controller
{
    public function show(User $user)
    {
        $user->loadCount('followers');

        $posts = $user->posts()
            ->with(['user', 'media', 'category'])
            ->withCount('claps')
            ->latest()
            ->paginate(8);

        return view('profile.show', ['user' => $user, 'posts' => $posts]);
    }
}
