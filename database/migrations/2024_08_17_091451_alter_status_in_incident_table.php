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
        Schema::table('incident', function (Blueprint $table) {
            $table->string('status')->change(); // เปลี่ยนประเภทคอลัมน์เป็น string
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('incident', function (Blueprint $table) {
            $table->text('status')->change(); // กลับไปใช้ประเภทเดิมหากมีการ rollback
        });
    }
};
