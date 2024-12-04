<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orphans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commune_id')->nullable();
            $table->unsignedBigInteger('widow_id')->nullable();
            $table->string('fullname');
            $table->date('birthdate');
            $table->text('health_status')->nullable();
            $table->string('occupation')->nullable();
            $table->string('workplace')->nullable();
            $table->boolean('at_home')->default(false);
            $table->boolean('married')->default(false);
            $table->timestamps();

            $table->foreign('commune_id')->references('id')->on('communes')->onDelete('set null');
            $table->foreign('widow_id')->references('id')->on('widows')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orphans');
    }
};
