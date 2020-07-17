<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'Administrador';
        $role->description = 'Puede acceder a todos los componentes del sistema';
        $role->save();

        $role = new Role();
        $role->name = 'Docente';
        $role->description = 'Acceso a la administración del módulo de notas de alumnos';
        $role->save();

        $role = new Role();
        $role->name = 'Secretaria';
        $role->description = 'Acceso a la administración de inscripción y notas de alumnos ';
        $role->save();


    }
}
