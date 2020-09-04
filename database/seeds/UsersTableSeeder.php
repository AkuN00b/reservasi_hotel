<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'Admin Hotel',
            'username' => 'adminhotel11',
            'email' => 'adminhotel@gmail.com',
            'password' => bcrypt('adminhotel11'),

        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'Receptionist Hotel',
            'username' => 'receptionisthotel22',
            'email' => 'receptionisthotel@gmail.com',
            'password' => bcrypt('receptionisthotel22'),
        ]);

        DB::table('users')->insert([
            'role_id' => '3',
            'name' => 'Customer Hotel',
            'username' => 'customerhotel33',
            'email' => 'customerhotel@gmail.com',
            'password' => bcrypt('customerhotel33'),
        ]);
    }
}
