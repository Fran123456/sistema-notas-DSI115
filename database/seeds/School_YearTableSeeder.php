<?php

use Illuminate\Database\Seeder;
use App\SchoolYear;
use App\SchoolPeriod;

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
      $year->start_date = '2020-03-01';
      $year->end_date = '2020-09-30';
      $year->year = "2020";
      $year->active = true;
      $year->save();

      $time1 = new SchoolPeriod();
      $time1->start_date = '2020-03-01';
      $time1->end_date = '2020-04-30';
      $time1->current = true;
      $time1->school_year_id	 = $year->id;
      $time1->save();

      $time2 = new SchoolPeriod();
      $time2->start_date = '2020-05-01';
      $time2->end_date = '2020-06-30';
      $time2->current = false;
      $time2->school_year_id	 = $year->id;
      $time2->save();

      $time3 = new SchoolPeriod();
      $time3->start_date = '2020-07-01';
      $time3->end_date = '2020-08-31';
      $time3->current = false;
      $time3->school_year_id	 = $year->id;
      $time3->save();
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
