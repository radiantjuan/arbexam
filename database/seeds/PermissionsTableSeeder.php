<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $breads = [
            'browse',
            'add',
            'edit',
            'delete',
        ];

        $features =
        [
            'user',
            'expenses',
            'expenses_category',
            'roles'
        ];

        foreach($features as $feature)
        {
            foreach($breads as $bread)
            {
                DB::table('permissions')->insert([
                    'name' => $bread.'_'.$feature,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]);
            }
        }
    }
}
