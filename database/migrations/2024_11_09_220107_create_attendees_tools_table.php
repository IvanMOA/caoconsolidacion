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
        Schema::create('attendee_tool', function (Blueprint $table) {
            $table->id();
            $table->integer("attendee_id")->references('id')->on('attendee');
            $table->integer("tool_id")->references('id')->on('tool');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendee_tool');
    }
};
