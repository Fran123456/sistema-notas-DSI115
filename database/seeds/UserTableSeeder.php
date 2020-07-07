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
        $user->save();
        $user->roles()->attach(Role::where('name', 'Administrador')->first());
    }
}
