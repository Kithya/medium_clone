<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;

test('home page renders the story feed instead of the welcome page', function () {
    $category = Category::create(['name' => 'Technology']);
    $author = User::factory()->create(['name' => 'Mina Writer']);
    $post = Post::factory()->create([
        'category_id' => $category->id,
        'user_id' => $author->id,
        'title' => 'A Better Reading Flow',
    ]);

    $response = $this->get('/');

    $response
        ->assertSuccessful()
        ->assertSee('Stories for you')
        ->assertSee($post->title)
        ->assertDontSee('Documentation');
});

test('guests can browse public reading pages and are redirected for protected actions', function () {
    $category = Category::create(['name' => 'Design']);
    $author = User::factory()->create();
    $post = Post::factory()->create([
        'category_id' => $category->id,
        'user_id' => $author->id,
        'title' => 'Designing Quiet Interfaces',
    ]);

    $this->get(route('post.show', ['username' => $author->username, 'post' => $post]))
        ->assertSuccessful()
        ->assertSee($post->title);

    $this->get(route('profile.show', $author))
        ->assertSuccessful()
        ->assertSee($author->name)
        ->assertSee($post->title);

    $this->get(route('post.byCategory', $category))
        ->assertSuccessful()
        ->assertSee('Design')
        ->assertSee($post->title);

    $this->get(route('post.create'))
        ->assertRedirect(route('login'));

    $this->post(route('clap', $post))
        ->assertRedirect(route('login'));

    $this->post(route('follow', $author))
        ->assertRedirect(route('login'));
});

test('article urls are scoped to the author username', function () {
    $category = Category::create(['name' => 'Writing']);
    $author = User::factory()->create();
    $post = Post::factory()->create([
        'category_id' => $category->id,
        'user_id' => $author->id,
    ]);

    $this->get(route('post.show', ['username' => $author->username, 'post' => $post]))
        ->assertSuccessful();

    $this->get(route('post.show', ['username' => 'someone-else', 'post' => $post]))
        ->assertNotFound();
});
