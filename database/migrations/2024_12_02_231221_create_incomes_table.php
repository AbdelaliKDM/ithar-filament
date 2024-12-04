<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('widow_id');
            $table->string('name');
            $table->integer('amount');
            $table->enum('type', ['salary', 'bonus']);
            $table->timestamps();

            $table->foreign('widow_id')->references('id')->on('widows')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('incomes');
    }
};
