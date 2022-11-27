<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_weighting', function (Blueprint $table) {
            $table->id();
            $table->foreignId('decision_maker_id')->constrained()->onDelete('cascade');
            $table->foreignId('session_id')->constrained('decision_sessions')->onDelete('cascade');
            $table->string('area',50);
            $table->float('value', 8, 6);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temp_weighting');
    }
};
