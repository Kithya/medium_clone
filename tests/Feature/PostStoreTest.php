<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('authenticated users can create posts', function () {
    Storage::fake('public');

    $user = User::factory()->create();
    $category = Category::create([
        'name' => 'Technology',
    ]);

    $response = $this->actingAs($user)->post(route('post.store'), [
        'image' => new UploadedFile(public_path('medium.png'), 'medium.png', 'image/png', null, true),
        'title' => 'My first post',
        'content' => 'This is the body of the post.',
        'category_id' => $category->id,
        'published_at' => now()->format('Y-m-d H:i:s'),
    ]);

    $response->assertRedirect(route('dashboard', absolute: false));
    $response->assertSessionHasNoErrors();

    $post = Post::query()->sole();
    $this->assertModelExists($post);
    expect($post->title)->toBe('My first post');
    expect($post->slug)->toBe('my-first-post');
    expect($post->category_id)->toBe($category->id);
    expect($post->user_id)->toBe($user->id);
    Storage::disk('public')->assertExists($post->image);
});
