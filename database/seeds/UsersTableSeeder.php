<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([

            'name'      => 'Thiago Ferreira',
            'email'     => 'thiagomilton.f@gmail.com',
            'password'  => bcrypt('123456'),
            'idTipoAdminUser' => 1

        ]);
    }
}
