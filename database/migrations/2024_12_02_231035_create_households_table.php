<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('households', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('widow_id');
            $table->enum('housing_type', ['family', 'standalone', 'rent']);
            $table->enum('building_type', ['gypsum', 'cement']);
            $table->enum('building_condition', ['good', 'medium', 'bad']);
            $table->enum('furniture_condition', ['good', 'medium', 'bad']);
            $table->enum('clothing_condition', ['good', 'medium', 'bad']);
            $table->double('rent_cost')->default(0);
            $table->integer('members_num')->default(0);
            $table->integer('students_num')->default(0);
            $table->boolean('has_fridge')->default(false);
            $table->boolean('has_cooker')->default(false);
            $table->boolean('has_tv')->default(false);
            $table->boolean('has_ac')->default(false);
            $table->timestamps();

            $table->foreign('widow_id')->references('id')->on('widows')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('households');
    }
};
