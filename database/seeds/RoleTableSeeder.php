<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;


class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $adminPermissions = [
            1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16
        ];

        $userPermissions = [
            5,6,7,8
        ];

        DB::table('roles')->insert([
            'name' => 'Admin',
            'permissions' => json_encode($adminPermissions),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('roles')->insert([
            'name' => 'User',
            'permissions' => json_encode($userPermissions),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
