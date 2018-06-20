<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PredictionTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreatePrediction()
    {
        $admin = \App\User::find(1);
        $prediction = factory('App\Prediction')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $prediction) {
            $browser->loginAs($admin)
                ->visit(route('admin.predictions.index'))
                ->clickLink('Add new')
                ->select("user_id", $prediction->user_id)
                ->select("match_id", $prediction->match_id)
                ->type("result_team1", $prediction->result_team1)
                ->type("result_team2", $prediction->result_team2)
                ->type("points", $prediction->points)
                ->press('Save')
                ->assertRouteIs('admin.predictions.index')
                ->assertSeeIn("tr:last-child td[field-key='user']", $prediction->user->name)
                ->assertSeeIn("tr:last-child td[field-key='match']", $prediction->match->start_time)
                ->assertSeeIn("tr:last-child td[field-key='result_team1']", $prediction->result_team1)
                ->assertSeeIn("tr:last-child td[field-key='result_team2']", $prediction->result_team2)
                ->assertSeeIn("tr:last-child td[field-key='points']", $prediction->points);
        });
    }

    public function testEditPrediction()
    {
        $admin = \App\User::find(1);
        $prediction = factory('App\Prediction')->create();
        $prediction2 = factory('App\Prediction')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $prediction, $prediction2) {
            $browser->loginAs($admin)
                ->visit(route('admin.predictions.index'))
                ->click('tr[data-entry-id="' . $prediction->id . '"] .btn-info')
                ->select("user_id", $prediction2->user_id)
                ->select("match_id", $prediction2->match_id)
                ->type("result_team1", $prediction2->result_team1)
                ->type("result_team2", $prediction2->result_team2)
                ->type("points", $prediction2->points)
                ->press('Update')
                ->assertRouteIs('admin.predictions.index')
                ->assertSeeIn("tr:last-child td[field-key='user']", $prediction2->user->name)
                ->assertSeeIn("tr:last-child td[field-key='match']", $prediction2->match->start_time)
                ->assertSeeIn("tr:last-child td[field-key='result_team1']", $prediction2->result_team1)
                ->assertSeeIn("tr:last-child td[field-key='result_team2']", $prediction2->result_team2)
                ->assertSeeIn("tr:last-child td[field-key='points']", $prediction2->points);
        });
    }

    public function testShowPrediction()
    {
        $admin = \App\User::find(1);
        $prediction = factory('App\Prediction')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $prediction) {
            $browser->loginAs($admin)
                ->visit(route('admin.predictions.index'))
                ->click('tr[data-entry-id="' . $prediction->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='user']", $prediction->user->name)
                ->assertSeeIn("td[field-key='match']", $prediction->match->start_time)
                ->assertSeeIn("td[field-key='result_team1']", $prediction->result_team1)
                ->assertSeeIn("td[field-key='result_team2']", $prediction->result_team2)
                ->assertSeeIn("td[field-key='points']", $prediction->points);
        });
    }

}
