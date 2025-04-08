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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pixel_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('job_title')->nullable();
            $table->string('annual_revenue')->nullable();
            $table->text('insights')->nullable();
            
            // LinkedIn data
            $table->unsignedInteger('linkedin_connections')->nullable();
            $table->date('linkedin_joined_date')->nullable();
            $table->date('linkedin_last_active_date')->nullable();
            
            // Twitter data
            $table->unsignedInteger('twitter_connections')->nullable();
            $table->date('twitter_joined_date')->nullable();
            $table->date('twitter_last_active_date')->nullable();
            
            // Instagram data
            $table->unsignedInteger('instagram_connections')->nullable();
            $table->date('instagram_joined_date')->nullable();
            $table->date('instagram_last_active_date')->nullable();
            
            $table->boolean('is_notified')->default(false);
            $table->boolean('is_exported')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
