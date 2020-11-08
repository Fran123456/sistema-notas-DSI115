<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(DegreeTableSeeder::class);
        $this->call(School_YearTableSeeder::class);
        $this->call(SubjectTableSeeder::class);
        $this->call(StudentTableSeeder::class);
        $this->call(DegreeSchoolYearSeeder::class);
        $this->call(DegreeSchoolSubjectSeeder::class);
        $this->call(AttendanceStudentSeeder::class);
        $this->call(BehaviorStudentsSeeder::class);
    }
}
