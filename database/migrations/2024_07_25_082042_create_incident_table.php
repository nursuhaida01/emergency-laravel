<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incident', function (Blueprint $table) {
            $table->id();
            $table->string('case_number')->unique();
            $table->string('rate');
            $table->string('location');
            $table->string('help_needed');
            $table->integer('quantity');
            $table->text('description');
            $table->string('contact_number');
            $table->longText('images')->nullable(); // หรือใช้ LONGTEXT หากจำเป็น
            $table->unsignedBigInteger('user_id');     // เชื่อมโยงกับตาราง users
            $table->text('status')->nullable();
            $table->string('remarks');
            $table->decimal('latitude', 10, 7)->nullable(); // เก็บค่าละติจูด
            $table->decimal('longitude', 10, 7)->nullable(); // เก็บค่าลองจิจูด
            $table->timestamps();

            // กำหนด foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident');
    }
};
