<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class inventoryCategory extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('inventory_category')->insert([
            'name' => 'MUEBLES ESCOLARES',
            'description' => Str::random(15),

        ]);
        DB::table('inventory_category')->insert([
            'name' => 'DONACION COMIDA',
            'description' => Str::random(15),

        ]);
        DB::table('inventory_category')->insert([
            'name' => 'ELEMENTOS DIDACTICOS',
            'description' => Str::random(15),

        ]);
    }
}
