<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert(['id' => 1 ,'name' => 'Aguascalientes']);
        DB::table('states')->insert(['id' => 2 ,'name' => 'Baja California']);
        DB::table('states')->insert(['id' => 3 ,'name' => 'Baja California Sur']);
        DB::table('states')->insert(['id' => 4 ,'name' => 'Campeche']);
        DB::table('states')->insert(['id' => 5 ,'name' => 'Coahuila']);
        DB::table('states')->insert(['id' => 6 ,'name' => 'Colima']);
        DB::table('states')->insert(['id' => 7 ,'name' => 'Chiapas']);
        DB::table('states')->insert(['id' => 8 ,'name' => 'Chihuahua']);
        DB::table('states')->insert(['id' => 9 ,'name' => 'Ciudad de México']);
        DB::table('states')->insert(['id' => 10 ,'name' => 'Durango']);
        DB::table('states')->insert(['id' => 11 ,'name' => 'Guanajuato']);
        DB::table('states')->insert(['id' => 12 ,'name' => 'Guerrero']);
        DB::table('states')->insert(['id' => 13 ,'name' => 'Hidalgo']);
        DB::table('states')->insert(['id' => 14 ,'name' => 'Jalisco']);
        DB::table('states')->insert(['id' => 15 ,'name' => 'México']);
        DB::table('states')->insert(['id' => 16 ,'name' => 'Michoacán']);
        DB::table('states')->insert(['id' => 17 ,'name' => 'Morelos']);
        DB::table('states')->insert(['id' => 18 ,'name' => 'Nayarit']);
        DB::table('states')->insert(['id' => 19 ,'name' => 'Nuevo León']);
        DB::table('states')->insert(['id' => 20 ,'name' => 'Oaxaca']);
        DB::table('states')->insert(['id' => 21 ,'name' => 'Puebla']);
        DB::table('states')->insert(['id' => 22 ,'name' => 'Querétaro']);
        DB::table('states')->insert(['id' => 23 ,'name' => 'Quintana Roo']);
        DB::table('states')->insert(['id' => 24 ,'name' => 'San Luis Potosí']);
        DB::table('states')->insert(['id' => 25 ,'name' => 'Sinaloa']);
        DB::table('states')->insert(['id' => 26 ,'name' => 'Sonora']);
        DB::table('states')->insert(['id' => 27 ,'name' => 'Tabasco']);
        DB::table('states')->insert(['id' => 28 ,'name' => 'Tamaulipas']);
        DB::table('states')->insert(['id' => 29 ,'name' => 'Tlaxcala']);
        DB::table('states')->insert(['id' => 30 ,'name' => 'Veracruz']);
        DB::table('states')->insert(['id' => 31 ,'name' => 'Yucatán']);
        DB::table('states')->insert(['id' => 32 ,'name' => 'Zacatecas']);
    }

}
