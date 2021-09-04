<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

//Models
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

        //create admin
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('11AAbb##'),
            'last_name' => 'admin',
            'status' => 'ACTIVO',
            'phone' => '0000000000',
            'position' => 'admin',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        User::where('email', "admin@admin.com")->delete();
    }
}
