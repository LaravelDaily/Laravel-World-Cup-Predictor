<?php

use Illuminate\Database\Seeder;
use App\Match;

class MatchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $matches = [
            ['team1_id' => 28, 'team2_id' => 4, 'start_time' => '2018-06-14 18:00:00'],
            ['team1_id' => 6, 'team2_id' => 18, 'start_time' => '2018-06-15 17:00:00'],
            ['team1_id' => 7, 'team2_id' => 2, 'start_time' => '2018-06-15 18:00:00'],
            ['team1_id' => 27, 'team2_id' => 30, 'start_time' => '2018-06-15 21:00:00'],
            ['team1_id' => 23, 'team2_id' => 1, 'start_time' => '2018-06-16 13:00:00'],
            ['team1_id' => 14, 'team2_id' => 25, 'start_time' => '2018-06-16 16:00:00'],
            ['team1_id' => 17, 'team2_id' => 21, 'start_time' => '2018-06-16 19:00:00'],
            ['team1_id' => 20, 'team2_id' => 8, 'start_time' => '2018-06-16 21:00:00'],
            ['team1_id' => 11, 'team2_id' => 29, 'start_time' => '2018-06-17 16:00:00'],
            ['team1_id' => 24, 'team2_id' => 12, 'start_time' => '2018-06-17 18:00:00'],
            ['team1_id' => 15, 'team2_id' => 32, 'start_time' => '2018-06-17 21:00:00'],
            ['team1_id' => 31, 'team2_id' => 5, 'start_time' => '2018-06-18 15:00:00'],
            ['team1_id' => 19, 'team2_id' => 13, 'start_time' => '2018-06-18 18:00:00'],
            ['team1_id' => 10, 'team2_id' => 22, 'start_time' => '2018-06-18 21:00:00'],
            ['team1_id' => 16, 'team2_id' => 3, 'start_time' => '2018-06-19 15:00:00'],
            ['team1_id' => 26, 'team2_id' => 9, 'start_time' => '2018-06-19 18:00:00'],
        ];

        foreach ($matches as $match)
        {
            Match::create($match);
        }
    }
}
