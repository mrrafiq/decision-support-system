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
        Schema::create('borda', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('decision_sessions')->onDelete('cascade');
            $table->foreignId('school_id')->constrained();
            $table->float('score', 8, 6);
            $table->integer('rank');
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
        Schema::dropIfExists('borda');
    }
};
