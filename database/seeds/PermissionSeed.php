<?php

use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'user_management_access',],
            ['id' => 2, 'title' => 'permission_access',],
            ['id' => 3, 'title' => 'permission_create',],
            ['id' => 4, 'title' => 'permission_edit',],
            ['id' => 5, 'title' => 'permission_view',],
            ['id' => 6, 'title' => 'permission_delete',],
            ['id' => 7, 'title' => 'role_access',],
            ['id' => 8, 'title' => 'role_create',],
            ['id' => 9, 'title' => 'role_edit',],
            ['id' => 10, 'title' => 'role_view',],
            ['id' => 11, 'title' => 'role_delete',],
            ['id' => 12, 'title' => 'user_access',],
            ['id' => 13, 'title' => 'user_create',],
            ['id' => 14, 'title' => 'user_edit',],
            ['id' => 15, 'title' => 'user_view',],
            ['id' => 16, 'title' => 'user_delete',],
            ['id' => 17, 'title' => 'team_access',],
            ['id' => 18, 'title' => 'team_create',],
            ['id' => 19, 'title' => 'team_edit',],
            ['id' => 20, 'title' => 'team_view',],
            ['id' => 21, 'title' => 'team_delete',],
            ['id' => 22, 'title' => 'match_access',],
            ['id' => 23, 'title' => 'match_create',],
            ['id' => 24, 'title' => 'match_edit',],
            ['id' => 25, 'title' => 'match_view',],
            ['id' => 26, 'title' => 'match_delete',],
            ['id' => 27, 'title' => 'prediction_access',],
            ['id' => 28, 'title' => 'prediction_create',],
            ['id' => 29, 'title' => 'prediction_edit',],
            ['id' => 30, 'title' => 'prediction_view',],
            ['id' => 31, 'title' => 'prediction_delete',],

        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
