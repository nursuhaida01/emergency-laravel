<?php

// database/migrations/xxxx_xx_xx_create_statuses_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('incident_id'); // ใช้สำหรับเก็บ ID ของเคส
            $table->boolean('base_departure')->default(false);
            $table->boolean('scene_arrival')->default(false);
            $table->boolean('scene_departure')->default(false);
            $table->boolean('hospital_arrival')->default(false);
            $table->boolean('base_arrival')->default(false);
            $table->timestamps();

            $table->foreign('incident_id')->references('id')->on('incident')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('statuses');
    }
}
