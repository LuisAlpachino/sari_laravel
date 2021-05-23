<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert(['id' => 1, 'name' => 'Pendiente']);
        DB::table('status')->insert(['id' => 2, 'name' => 'Aprobado']);
        DB::table('status')->insert(['id' => 3, 'name' => 'Declinado']);
    }
}
