<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('incident', function (Blueprint $table) {
            $table->string('case_number')->nullable()->unique();
        });
    }
    
    public function down()
    {
        Schema::table('incident', function (Blueprint $table) {
            $table->dropColumn('case_number');
        });
    }
    
};
