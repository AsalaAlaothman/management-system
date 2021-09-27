<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
            'usertype' => "HR"
        ]);
        DB::table('user_types')->insert([
            'usertype' => "Management"
        ]);
        DB::table('user_types')->insert([
            'usertype' => "Accountant"
        ]);
        DB::table('user_types')->insert([
            'usertype' => "Employee"
        ]);
    }
}