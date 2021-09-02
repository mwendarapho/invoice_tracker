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

      /*  $staffs=[
            ['code'=>'ST001','name'=>'Staff01'],
            ['code'=>'ST002','name'=>'Staff02'],
            ['code'=>'ST003','name'=>'Staff03']
        ];
        for($i=0; $i< count($staffs); $i++) {
                DB::table('staff')->insert([
                    'code' => $staffs[$i]['code'],
                    'name' => $staffs[$i]['name'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
        }*/
    }
}
