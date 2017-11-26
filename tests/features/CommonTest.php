<?php

namespace Antoniputra\Ngeblog\Tests\Features;

use Antoniputra\Ngeblog\Tests\TestCase;

class CommonTest extends TestCase
{
    /** @test */
    public function anonymous_can_visit_admin_page()
    {
        // $tables = \DB::select("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name;");
        // dd($tables);
        $this->get(route('ngeblog.dashboard'))
            ->assertStatus(200);
    }

    /** @test */
    public function anonymous_can_not_access_admin_page()
    {
        // setup protection logic
        \Ngeblog::auth(function ($request) {
            return auth()->check();
        });

        $this->get(route('ngeblog.dashboard'))
            ->assertStatus(403);
    }
}
