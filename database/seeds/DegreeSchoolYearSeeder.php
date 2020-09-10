<?php

use Illuminate\Database\Seeder;
use App\SchoolYear;
use App\Degree;
use App\User;
use App\DegreeSchoolYear;

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
        $users=User::where('role_id',2)->get();    

        foreach($schoolYears as $year){
            foreach($degrees as $degree){
                $degreeSchoolYear=new DegreeSchoolYear();                
                $degreeSchoolYear->school_year_id=$year->id;
                $degreeSchoolYear->user_id=$degree->id+2;
                $degreeSchoolYear->degree_id=$degree->id;
                $degreeSchoolYear->capacity=random_int(25,35);
                $degreeSchoolYear->save();
            }
        }
    }          
}
