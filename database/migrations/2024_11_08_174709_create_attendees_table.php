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
        Schema::create('attendees', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->boolean("is_recurrent");
            $table->date("birthday");
            $table->string("who_invited_me")->nullable();
            $table->string('phone', 15)->nullable();
            $table->boolean("has_gone_to_another_church")->nullable();
            $table->string("church_name")->nullable();
            $table->boolean("is_interested_in_bible_study")->nullable();
            $table->string("requests")->nullable();
            $table->date("date_of_welcome");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendees');
    }
};
