<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User:: create([
            'name'=> 'administrador',
            'lastname'=>'jj',
            'cedula'=>'1726100488',
            'email'=>'administrador@gmail.com',
            'phone'=> '0999999999',
            'password'=> Hash:: make("123456789"),
        ]);
        User:: create([
            'name'=> 'recepcion',
            'lastname'=>'jj',
            'cedula'=>'1726100488',
            'email'=>'recepcionr@gmail.com',
            'phone'=> '0999999999',
            'password'=> Hash:: make("123456789"),
        ]);
        User:: create([
            'name'=> 'flornacional',
            'lastname'=>'jj',
            'cedula'=>'1726100488',
            'email'=>'flornacional@gmail.com',
            'phone'=> '0999999999',
            'password'=> Hash:: make("123456789"),
        ]);
        User:: create([
            'name'=> 'digitador',
            'lastname'=>'jj',
            'cedula'=>'1726100488',
            'email'=>'digitador@gmail.com',
            'phone'=> '0999999999',
            'password'=> Hash:: make("123456789"),
        ]);
    }
}
