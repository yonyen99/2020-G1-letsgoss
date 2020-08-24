<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('city');
            $table->boolean('check')->default(0);
            $table->string('password');
            $table->string('profile')->default('user.png');
            $table->integer('role')->default(0);
            $table->timestamps();
        });
        //Insert the default admin user
        DB::table('users')->insert(
            array(
                'id' => 1,
                'firstname' => 'Admin',
                'lastname' => 'Example',
                'email' => 'manager@example.com',
                'city' => 'Phnom Penh',
                'password' => Hash::make('12345678'),
                'role'=>1
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
