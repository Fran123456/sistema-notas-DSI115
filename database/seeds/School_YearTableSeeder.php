<?php

use Illuminate\Database\Seeder;
use App\SchoolYear;

class School_YearTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $year = new SchoolYear();
      $year->start_date = '2020-01-01';
      $year->end_date = '2020-12-31';
      $year->year = "2020";
      $year->active = true;
      $year->save();

    /*  $year2 = new SchoolYear();
      $year2->start_date = '2019-01-01';
      $year2->end_date = '2019-12-31';
      $year2->year = "2019";
      $year2->active = false;
      $year2->save();

      $year3 = new SchoolYear();
      $year3->start_date = '2018-01-01';
      $year3->end_date = '2018-12-31';
      $year3->year = "2018";
      $year3->active = false;
      $year3->save();*/


    }
}
