<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

//Models
use App\Models\Rol;
use App\Models\User;

class CreateRoleAdminForTableRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $array = [
            [ 'name' => 'ADMIN', 'description' => 'Super usuario' ],
            [ 'name' => 'REPORTERO', 'description' => 'Rol para el reportero'],
            [ 'name' => 'EDITOR', 'description' => 'Super usuario'],
            ];

        foreach ($array as  $data) {
            Rol::create([    
                'name' => $data['name'],
                'description' => $data['description'],
                'status' => 'ACTIVO'
            ]);
        }

        //create admin
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('11AAbb##'),
            'last_name' => 'admin',
            'status' => 'ACTIVO',
            'phone' => '0000000000',
            'position' => 'admin',
            'fk_roles' => 1
        ]);
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
