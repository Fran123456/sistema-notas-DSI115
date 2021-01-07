<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       for ($i=0; $i <40 ; $i++) {
        DB::table('inventory_products')->insert([
            'code' => Str::random(10),
            'img' => null,
            'model' => Str::random(5),
            'name' => Str::random(5),
            'category_id' => random_int(1,3),
            'state' =>random_int(0,1),
            'stock' => rand(50,400),

        ]);
       }
    }
}
