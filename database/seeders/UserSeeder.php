<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Asala",
            'email' => 'admin@admin.com',
            'password' => Hash::make('12341234'),
            'usertype' => 'Admin'
        ]);
        DB::table('users')->insert([
            'name' => "HR",
            'email' => 'HR@HR.com',
            'password' => Hash::make('12341234'),
            'usertype' => 'HR'
        ]); 
         DB::table('users')->insert([
            'name' => "Management",
            'email' => 'Management@Management.com',
            'password' => Hash::make('12341234'),
            'usertype' => 'Management'
        ]);
        DB::table('users')->insert([
            'name' => "Accountant",
            'email' => 'Accountant@Accountant.com',
            'password' => Hash::make('12341234'),
            'usertype' => 'Accountant'
        ]);
        DB::table('users')->insert([
            'name' => "Employee_1",
            'email' => 'Employee_1@Employee.com',
            'password' => Hash::make('12341234'),
            'usertype' => 'Employee'
        ]);
    }
}
