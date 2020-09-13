<?php

use Illuminate\Database\Seeder;
use App\Subject;
class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$subjects = array('Ciencias','Sociales','Matematicas','Lenguaje',
          'Fisica', 'Biologia','Moral y Civica'
         );

    	  foreach ($subjects as $key => $value) {
    	 	$year = new Subject();
	     	$year->name = $value;
	     	$year->active = true;
	     	$year->save();
    	  }
    }
}
