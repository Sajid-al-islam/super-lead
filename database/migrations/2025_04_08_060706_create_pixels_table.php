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
        Schema::create('pixels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('domain');
            $table->string('pixel_id')->unique();
            $table->string('pixel_code')->unique();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_verified')->default(false);
            $table->dateTime('last_activity')->nullable();
            $table->unsignedInteger('visitor_count')->default(0);
            $table->unsignedInteger('lead_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pixels');
    }
};
