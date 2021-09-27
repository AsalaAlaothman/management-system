<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('requesttypes')->insert([
            'requesttype' => "HR"
        ]);
        DB::table('requesttypes')->insert([
            'requesttype' => "Management"
        ]);
        DB::table('requesttypes')->insert([
            'requesttype' => "Accountant"
        ]);

    }
}