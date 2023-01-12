<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('merchants')->insert([
            'name' => 'GO-PAY',
        ]);
        DB::table('merchants')->insert([
            'name' => 'OVO',
        ]);
        DB::table('merchants')->insert([
            'name' => 'ShopeePay',
        ]);
        DB::table('merchants')->insert([
            'name' => 'DANA',
        ]);
        DB::table('merchants')->insert([
            'name' => 'Alfamart',
        ]);
    }
}
