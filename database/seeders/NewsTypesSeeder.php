<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news_types')->insert(['id' => 1, 'name' => 'Política']);
        DB::table('news_types')->insert(['id' => 2, 'name' => 'Economía']);
        DB::table('news_types')->insert(['id' => 3, 'name' => 'Deportes']);
        DB::table('news_types')->insert(['id' => 4, 'name' => 'Clima']);
        DB::table('news_types')->insert(['id' => 5, 'name' => 'Culturales']);
        DB::table('news_types')->insert(['id' => 6, 'name' => 'Sociales']);
        DB::table('news_types')->insert(['id' => 7, 'name' => 'Seguridad']);
        DB::table('news_types')->insert(['id' => 8, 'name' => 'Tecnología']);
        DB::table('news_types')->insert(['id' => 9, 'name' => 'Salud']);
    }

}
