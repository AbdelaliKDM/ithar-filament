<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('widows', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->date('birthdate');
            $table->string('phone')->nullable();
            $table->double('salary')->default(0);
            $table->enum('education_level', ['prim', 'bem', 'bac', 'univ']);
            $table->string('address')->nullable();
            $table->string('ccp_number')->nullable();
            $table->text('health_status')->nullable();
            $table->string('occupation')->nullable();
            $table->boolean('insurance')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('widows');
    }
};
