<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdminDataInsert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $admin_data = array(
            'first_name'    => 'Admin',
            'last_name'    => 'Admin',
            'username'    => 'admin',
            'email'    => 'admin@gmail.com',
            'password'    => '$2y$10$Lr9SBjlEVczNxYHidlc86O.Z7J1cS1TOYBLL7Qlmg4iJlrxbc5ArG', // Password : 12345678
            'role'    => 'admin'
            );
        \DB::table('users')->insert($admin_data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
