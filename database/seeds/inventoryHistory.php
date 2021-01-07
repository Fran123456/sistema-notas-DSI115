<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class inventoryHistory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <40 ; $i++) {
            DB::table('inventory_history')->insert([
                'code' => Str::random(10),
                'reason' => Str::random(20),
                'lastStock' => random_int(200,300),
                'actualStock' => random_int(100,200),
                'responsable' => Str::random(20),
                'product_id' =>random_int(1,40),
                'updated_at' => Carbon::today()->subDays(rand(0, 365)),
                'created_at' => Carbon::today()->subDays(rand(0, 365)),


            ]);
           }
    }
}
