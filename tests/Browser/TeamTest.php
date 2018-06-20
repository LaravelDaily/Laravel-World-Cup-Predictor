<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class TeamTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateTeam()
    {
        $admin = \App\User::find(1);
        $team = factory('App\Team')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $team) {
            $browser->loginAs($admin)
                ->visit(route('admin.teams.index'))
                ->clickLink('Add new')
                ->type("name", $team->name)
                ->press('Save')
                ->assertRouteIs('admin.teams.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $team->name);
        });
    }

    public function testEditTeam()
    {
        $admin = \App\User::find(1);
        $team = factory('App\Team')->create();
        $team2 = factory('App\Team')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $team, $team2) {
            $browser->loginAs($admin)
                ->visit(route('admin.teams.index'))
                ->click('tr[data-entry-id="' . $team->id . '"] .btn-info')
                ->type("name", $team2->name)
                ->press('Update')
                ->assertRouteIs('admin.teams.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $team2->name);
        });
    }

    public function testShowTeam()
    {
        $admin = \App\User::find(1);
        $team = factory('App\Team')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $team) {
            $browser->loginAs($admin)
                ->visit(route('admin.teams.index'))
                ->click('tr[data-entry-id="' . $team->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $team->name);
        });
    }

}
