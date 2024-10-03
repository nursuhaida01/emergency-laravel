<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique(); // ทำให้ username เป็นค่าที่ไม่ซ้ำ
            $table->string('email')->unique(); // ทำให้ email เป็นค่าที่ไม่ซ้ำ
            $table->string('password');
            $table->string('phone')->nullable();
            $table->rememberToken(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
