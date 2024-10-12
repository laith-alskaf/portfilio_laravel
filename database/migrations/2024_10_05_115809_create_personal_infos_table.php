<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users")->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name');
            $table->string('line');
            $table->string('image');
            $table->string('my_number');
            $table->string('linkedIn');
            $table->string('github');
            $table->longText('about_me');
            $table->string('cv');
            $table->string('email')->unique();
            $table->string('knowledge');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_infos');
    }
};
