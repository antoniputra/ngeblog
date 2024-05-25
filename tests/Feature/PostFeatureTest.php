<?php

use AntoniPutra\Ngeblog\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Workbench\App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::first();
});

it('can read posts list', function () {
    $this->actingAs($this->user)
        ->json('GET', route('api.posts.index'))
        ->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) => 
            $json->hasAll('data', 'meta', 'links')
        );
});

it('can read posts stats', function () {
    $this->actingAs($this->user)
        ->json('GET', route('api.posts.stats'))
        ->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) => 
            $json->hasAll('total_all_time', 'total_last_month')
        );
});

it('can read a single post', function () {
    $post = createPost();

    $this->actingAs($this->user)
        ->json('GET', route('api.posts.show', $post->id))
        ->assertStatus(200)
        ->assertJson([
            'title' => $post->title,
        ]);
});

it('can create a post', function () {
    $postData = [
        'title' => 'Test Post',
        'excerpt' => 'This is a test excerpt.',
        'content' => 'This is a test content.',
    ];

    $this->actingAs($this->user)
        ->json('POST', route('api.posts.store'), $postData)
        ->assertStatus(200)
        ->assertJson([
            'title' => $postData['title'],
        ]);

    $this->assertDatabaseHas((new Post)->getTable(), $postData);
});

it('can update a post', function () {
    $post = createPost();

    $updatedData = [
        'title' => 'Updated Title',
        'excerpt' => 'Updated excerpt.',
        'content' => 'Updated content.'
    ];

    $this->actingAs($this->user)
        ->json('PUT', route('api.posts.update', $post->id), $updatedData)
        ->assertStatus(200)
        ->assertJson([
            'title' => $updatedData['title'],
        ]);

    $this->assertDatabaseHas((new Post)->getTable(), $updatedData);
});

it('can toggle visibility a post', function () {
    $post = createPost();

    $this->actingAs($this->user)
        ->json('PATCH', route('api.posts.toggleVisibility', $post->id))
        ->assertStatus(200)
        ->assertJson([
            'is_visible' => false,
        ]);
});

it('can delete a post', function () {
    $post = createPost();

    $this->actingAs($this->user)
        ->json('DELETE', route('api.posts.destroy', $post->id))
        ->assertStatus(200);

    $this->assertDatabaseMissing((new Post)->getTable(), ['id' => $post->id]);
});

function createPost() {
    return Post::create([
        'title' => 'Test Post',
        'slug' => str('Test Post')->slug(),
        'excerpt' => 'This is a test.',
        'content' => 'This is a test.',
        'is_visible' => true,
    ]);
}