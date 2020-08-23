<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Administrador';
        $user->email = 'administrador@mail.com';
        $user->password = Hash::make('administrador123');
        $user->photo = 'default.png';
        $user->role_id = 1;
        $user->save();
        $user->roles()->attach(Role::where('name', 'Administrador')->first());


        $user2 = new User();
        $user2->name = 'Margarita de Cruz';
        $user2->email = 'margaritacruz@mail.com';
        $user2->password = Hash::make('secretaria123');
        $user2->photo = 'default.png';
        $user2->role_id = 3;
        $user2->save();
        $user2->roles()->attach(Role::where('name', 'Secretaria')->first());


        $user3 = new User();
        $user3->name = 'Daniela Fernandez Canto';
        $user3->email = 'danielafernandez@mail.com';
        $user3->password = Hash::make('docente123');
        $user3->photo = 'default.png';
        $user3->role_id = 2;
        $user3->save();
        $user3->roles()->attach(Role::where('name', 'Docente')->first());

        factory(App\User::class , 10)->create();


    }
}
