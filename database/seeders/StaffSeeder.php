<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $staffs=[
            ['code'=>'200','name'=>'Tony Doer'],
            ['code'=>'201','name'=>'Alice Makena'],
            ['code'=>'202','name'=>'Peter Onyongo']
        ];
        for($i=0; $i< count($staffs); $i++) {
                DB::table('staff')->insert([
                    'code' => $staffs[$i]['code'],
                    'name' => $staffs[$i]['name'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
        }
    }
}
