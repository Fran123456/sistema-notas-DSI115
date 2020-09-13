<?php

use Illuminate\Database\Seeder;
use App\SchoolYear;
use App\Degree;
use App\User;
use App\DegreeSchoolSubject;
use App\Subject;

class DegreeSchoolSubjectSeeder extends Seeder
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
        $users=User::where('role_id',2)->get();
        $subjects=Subject::all();

        foreach ($schoolYears as $year) {
          foreach ($degrees as $degree) {
             foreach ($subjects as $subject) {
                 $degreeSchoolSubject= new DegreeSchoolSubject();
                 $degreeSchoolSubject->subject_id=$subject->id;
                 $degreeSchoolSubject->school_year_id=$year->id;
                 $number=random_int(0,sizeof($users)-1);
                 $degreeSchoolSubject->user_id=$users[$number]->id;
                 $degreeSchoolSubject->degree_id=$degree->id;
                 $degreeSchoolSubject->save();
             }
          }
        }


      /*  foreach($subjects as $subject){
            foreach($degrees as $degree){
                foreach($schoolYears as $year){
                    $degreeSchoolSubject= new DegreeSchoolSubject();
                    $degreeSchoolSubject->subject_id=$subject->id;
                    $degreeSchoolSubject->school_year_id=$year->id;
                    $number=random_int(0,sizeof($users)-1);
                    $degreeSchoolSubject->user_id=$users[$number]->id;
                    $degreeSchoolSubject->degree_id=$degree->id;
                    $degreeSchoolSubject->save();
                }
            }
        }*/
    }
}
