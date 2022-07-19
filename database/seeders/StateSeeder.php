<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states=['Printed','Checking','Dispatch','Out For Delivery'];
        foreach ($states as $state){
            DB::table('states')->insert([
                'name' =>$state,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
        }
    }
}
