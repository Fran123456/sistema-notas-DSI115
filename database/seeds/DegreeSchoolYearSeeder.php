<?php

use Illuminate\Database\Seeder;
use App\SchoolYear;
use App\Degree;
use App\User;
use App\DegreeSchoolYear;
use App\StudentHistory;
class DegreeSchoolYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        $degrees=Degree::all();
        $schoolYears=SchoolYear::all();


        foreach($schoolYears as $year)
        {
            foreach($degrees as $degree)
            {
                $userIn=User::where('role_id',2)->inRandomOrder()->first();
                $degreeSchoolYear=new DegreeSchoolYear();
                $degreeSchoolYear->school_year_id=$year->id;
                $degreeSchoolYear->user_id=$userIn->id;
                $degreeSchoolYear->degree_id=$degree->id;
                $degreeSchoolYear->capacity=random_int(25,35);
                $degreeSchoolYear->full=$degreeSchoolYear->capacity;
                $degreeSchoolYear->save();

                for ($i=0; $i <$degreeSchoolYear->capacity ; $i++)
                {
                  $studenti = factory(App\Student::class, 1)->create();
                  $history = StudentHistory::create([
                    'student_id' =>$studenti[0]->id,
                    'degree_id' => $degree->id,
                    'school_year_id'=> $year->id,
                    'status' => true
                  ]);
                }
            }
        }

    }
}
