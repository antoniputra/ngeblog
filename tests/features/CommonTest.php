<?php

namespace Antoniputra\Ngeblog\Tests\Features;

use Antoniputra\Ngeblog\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CommonTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function anonymous_can_visit_admin_page()
    {
        // $tables = \DB::select("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name;");
        // dd($tables);
        $this->get(route('ngeblog.dashboard'))
            ->assertResponseStatus(200);
    }

    /** @test */
    public function anonymous_can_not_access_admin_page()
    {
        // setup protection logic
        \Ngeblog::auth(function ($request) {
            return auth()->check();
        });

        $this->get(route('ngeblog.dashboard'))
            ->assertResponseStatus(403);
    }
}
