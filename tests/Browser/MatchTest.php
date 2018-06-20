<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class MatchTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateMatch()
    {
        $admin = \App\User::find(1);
        $match = factory('App\Match')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $match) {
            $browser->loginAs($admin)
                ->visit(route('admin.matches.index'))
                ->clickLink('Add new')
                ->select("team1_id", $match->team1_id)
                ->select("team2_id", $match->team2_id)
                ->type("start_time", $match->start_time)
                ->type("result1", $match->result1)
                ->type("result2", $match->result2)
                ->type("comment", $match->comment)
                ->press('Save')
                ->assertRouteIs('admin.matches.index')
                ->assertSeeIn("tr:last-child td[field-key='team1']", $match->team1->name)
                ->assertSeeIn("tr:last-child td[field-key='team2']", $match->team2->name)
                ->assertSeeIn("tr:last-child td[field-key='start_time']", $match->start_time)
                ->assertSeeIn("tr:last-child td[field-key='result1']", $match->result1)
                ->assertSeeIn("tr:last-child td[field-key='result2']", $match->result2)
                ->assertSeeIn("tr:last-child td[field-key='comment']", $match->comment);
        });
    }

    public function testEditMatch()
    {
        $admin = \App\User::find(1);
        $match = factory('App\Match')->create();
        $match2 = factory('App\Match')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $match, $match2) {
            $browser->loginAs($admin)
                ->visit(route('admin.matches.index'))
                ->click('tr[data-entry-id="' . $match->id . '"] .btn-info')
                ->select("team1_id", $match2->team1_id)
                ->select("team2_id", $match2->team2_id)
                ->type("start_time", $match2->start_time)
                ->type("result1", $match2->result1)
                ->type("result2", $match2->result2)
                ->type("comment", $match2->comment)
                ->press('Update')
                ->assertRouteIs('admin.matches.index')
                ->assertSeeIn("tr:last-child td[field-key='team1']", $match2->team1->name)
                ->assertSeeIn("tr:last-child td[field-key='team2']", $match2->team2->name)
                ->assertSeeIn("tr:last-child td[field-key='start_time']", $match2->start_time)
                ->assertSeeIn("tr:last-child td[field-key='result1']", $match2->result1)
                ->assertSeeIn("tr:last-child td[field-key='result2']", $match2->result2)
                ->assertSeeIn("tr:last-child td[field-key='comment']", $match2->comment);
        });
    }

    public function testShowMatch()
    {
        $admin = \App\User::find(1);
        $match = factory('App\Match')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $match) {
            $browser->loginAs($admin)
                ->visit(route('admin.matches.index'))
                ->click('tr[data-entry-id="' . $match->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='team1']", $match->team1->name)
                ->assertSeeIn("td[field-key='team2']", $match->team2->name)
                ->assertSeeIn("td[field-key='start_time']", $match->start_time)
                ->assertSeeIn("td[field-key='result1']", $match->result1)
                ->assertSeeIn("td[field-key='result2']", $match->result2)
                ->assertSeeIn("td[field-key='comment']", $match->comment);
        });
    }

}
