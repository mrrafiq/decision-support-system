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
        Schema::create('ahp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('decision_maker_id')->constrained();
            $table->foreignId('session_id')->constrained('decision_sessions');
            $table->foreignId('category_id')->constrained();
            $table->float('weight',8, 6);
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
        Schema::dropIfExists('ahp');
    }
};
