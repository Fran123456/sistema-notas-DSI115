<?php

use Illuminate\Database\Seeder;
use App\Degree;
class DegreeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $degree = new Degree();
        $degree->degree = '1';
        $degree->section = 'A';
        $degree->turn='m';
        $degree->save();

        $degree = new Degree();
        $degree->degree = '1';
        $degree->section = 'B';
        $degree->turn='t';
        $degree->save();

        $degree = new Degree();
        $degree->degree = '2';
        $degree->section = 'A';
        $degree->turn='m';
        $degree->save();

        $degree = new Degree();
        $degree->degree = '2';
        $degree->section = 'B';
        $degree->turn='t';
        $degree->save();

        $degree = new Degree();
        $degree->degree = '3';
        $degree->section = 'A';
        $degree->turn='m';
        $degree->save();

        $degree = new Degree();
        $degree->degree = '3';
        $degree->section = 'B';
        $degree->turn='t';
        $degree->save();

        $degree = new Degree();
        $degree->degree = '4';
        $degree->section = 'A';
        $degree->turn='m';
        $degree->save();

        $degree = new Degree();
        $degree->degree = '4';
        $degree->section = 'B';
        $degree->turn='t';
        $degree->save();

        $degree = new Degree();
        $degree->degree = '5';
        $degree->section = 'A';
        $degree->turn='m';
        $degree->save();

        $degree = new Degree();
        $degree->degree = '5';
        $degree->section = 'B';
        $degree->turn='t';
        $degree->save();

        $degree = new Degree();
        $degree->degree = '6';
        $degree->section = 'A';
        $degree->turn='m';
        $degree->save();

        $degree = new Degree();
        $degree->degree = '6';
        $degree->section = 'B';
        $degree->turn='t';
        $degree->save();
    }
}
