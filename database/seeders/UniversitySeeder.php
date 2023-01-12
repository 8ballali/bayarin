<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('universities')->insert([
            'name' => 'Universitas Dian Nuswantoro',
            'email' => 'dinus@gmail.com',
            'address' => 'Jl Imam Bonjol',
            'phone' => '12132323232',
        ]);
        DB::table('universities')->insert([
            'name' => 'Universitas Diponegoro',
            'email' => 'undip@gmail.com',
            'address' => 'Jl Tembalang',
            'phone' => '12123332232',
        ]);
        DB::table('universities')->insert([
            'name' => 'Universitas Negeri Semarang',
            'email' => 'unnes@gmail.com',
            'address' => 'Jl Sekaran',
            'phone' => '12132123232',
        ]);

    }
}
