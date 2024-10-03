<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('case'); // เชื่อมโยงกับตาราง incidents
            $table->unsignedBigInteger('user_id');     // เชื่อมโยงกับตาราง users
            $table->string('action_taken');
            $table->text('details')->nullable();
            $table->string('location');
            $table->dateTime('operation_date');
            $table->text('images')->nullable(); // เพิ่มคอลัมน์เพื่อเก็บชื่อไฟล์รูปภาพ
            $table->timestamps();

            // กำหนด Foreign Key constraints
            $table->foreign('case')->references('id')->on('incident')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operations');
    }
}
