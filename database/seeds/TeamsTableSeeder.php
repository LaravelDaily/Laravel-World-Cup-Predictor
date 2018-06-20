<?php

use Illuminate\Database\Seeder;
use App\Team;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = [
            'Australia',
            'Iran',
            'Japan',
            'Saudi Arabia',
            'South Korea',
            'Egypt',
            'Morocco',
            'Nigeria',
            'Senegal',
            'Tunisia',
            'Costa Rica',
            'Mexico',
            'Panama',
            'Argentina',
            'Brazil',
            'Colombia',
            'Peru',
            'Uruguay',
            'Belgium',
            'Croatia',
            'Denmark',
            'England',
            'France',
            'Germany',
            'Iceland',
            'Poland',
            'Portugal',
            'Russia',
            'Serbia',
            'Spain',
            'Sweden',
            'Switzerland'
        ];

        foreach ($teams as $team)
        {
            Team::create(['name' => $team]);
        }
    }
}
