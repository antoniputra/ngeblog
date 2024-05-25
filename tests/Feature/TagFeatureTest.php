<?php

use AntoniPutra\Ngeblog\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Workbench\App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::first();
});

it('can read tags list', function () {
    $this->actingAs($this->user)
        ->json('GET', route('api.tags.index'))
        ->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) => 
            $json->hasAll('data', 'meta', 'links')
        );
});

it('can read tags stats', function () {
    $this->actingAs($this->user)
        ->json('GET', route('api.tags.stats'))
        ->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) => 
            $json->hasAll('total_all_time', 'total_last_month')
        );
});

it('can read tags list as dropdown', function () {
    $this->actingAs($this->user)
        ->json('GET', route('api.tags.dropdown'))
        ->assertStatus(200);
});

it('can read a single tag', function () {
    $tag = createTag();

    $this->actingAs($this->user)
        ->json('GET', route('api.tags.show', $tag->id))
        ->assertStatus(200)
        ->assertJson([
            'title' => $tag->title,
        ]);
});

it('can create a tag', function () {
    $tagData = [
        'title' => 'Test Tag',
        'description' => 'This is a test tag.'
    ];

    $this->actingAs($this->user)
        ->json('POST', route('api.tags.store'), $tagData)
        ->assertStatus(200)
        ->assertJson([
            'title' => $tagData['title'],
        ]);

    $this->assertDatabaseHas((new Tag)->getTable(), $tagData);
});

it('can update a tag', function () {
    $tag = createTag();

    $updatedData = [
        'title' => 'Updated Title',
        'description' => 'Updated content.'
    ];

    $this->actingAs($this->user)
        ->json('PUT', route('api.tags.update', $tag->id), $updatedData)
        ->assertStatus(200)
        ->assertJson([
            'title' => $updatedData['title'],
        ]);

    $this->assertDatabaseHas((new Tag)->getTable(), $updatedData);
});

it('can toggle visibility a tag', function () {
    $tag = createTag();

    $this->actingAs($this->user)
        ->json('PATCH', route('api.tags.toggleVisibility', $tag->id))
        ->assertStatus(200)
        ->assertJson([
            'is_visible' => false,
        ]);
});

it('can delete a tag', function () {
    $tag = createTag();

    $this->actingAs($this->user)
        ->json('DELETE', route('api.tags.destroy', $tag->id))
        ->assertStatus(200);

    $this->assertDatabaseMissing((new Tag)->getTable(), ['id' => $tag->id]);
});

function createTag() {
    return Tag::create([
        'title' => 'Test Tag',
        'slug' => str('Test Tag')->slug(),
        'description' => 'This is a test tag.',
        'is_visible' => true,
    ]);
}