<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

test('users cannot follow themselves', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('follow', $user))
        ->assertUnprocessable();

    expect($user->followers()->count())->toBe(0);
});

test('follow interactions toggle cleanly and remain unique', function () {
    $author = User::factory()->create();
    $reader = User::factory()->create();

    $this->actingAs($reader)
        ->post(route('follow', $author))
        ->assertSuccessful()
        ->assertJson(['followersCount' => 1]);

    expect($author->followers()->count())->toBe(1);

    expect(fn () => DB::table('followers')->insert([
        'user_id' => $author->id,
        'follower_id' => $reader->id,
        'created_at' => now(),
    ]))->toThrow(QueryException::class);

    $this->actingAs($reader)
        ->post(route('follow', $author))
        ->assertSuccessful()
        ->assertJson(['followersCount' => 0]);

    expect($author->followers()->count())->toBe(0);
});

test('clap interactions toggle cleanly and remain unique', function () {
    $category = Category::create(['name' => 'Culture']);
    $author = User::factory()->create();
    $reader = User::factory()->create();
    $post = Post::factory()->create([
        'category_id' => $category->id,
        'user_id' => $author->id,
    ]);

    $this->actingAs($reader)
        ->post(route('clap', $post))
        ->assertSuccessful()
        ->assertJson(['clapsCount' => 1]);

    expect($post->claps()->count())->toBe(1);

    expect(fn () => DB::table('claps')->insert([
        'user_id' => $reader->id,
        'post_id' => $post->id,
        'created_at' => now(),
    ]))->toThrow(QueryException::class);

    $this->actingAs($reader)
        ->post(route('clap', $post))
        ->assertSuccessful()
        ->assertJson(['clapsCount' => 0]);

    expect($post->claps()->count())->toBe(0);
});
