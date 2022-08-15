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
        Schema::create('aras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('decision_maker_id')->constrained();
            $table->foreignId('session_id')->constrained('decision_sessions')->onDelete('cascade');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('school_id')->constrained();
            $table->integer('value');
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
        Schema::dropIfExists('aras');
    }
};
