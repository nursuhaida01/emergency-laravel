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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->text('image')->nullable();
            $table->string('username');
            $table->string('location');
            $table->timestamp('time');
            $table->string('category')->nullable();
            $table->unsignedBigInteger('view_count')->default(0); // เพิ่มคอลัมน์ view_count พร้อมค่าเริ่มต้นเป็น 0
            $table->timestamps();           // คอลัมน์ created_at และ updated_at
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
