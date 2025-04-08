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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('price', 10, 2);
            $table->string('billing_period')->default('monthly');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('max_pixels');
            $table->unsignedInteger('company_resolutions');
            $table->unsignedInteger('email_unlocks');
            $table->boolean('has_slack_notifications')->default(false);
            $table->boolean('has_csv_exports')->default(false);
            $table->boolean('has_trial')->default(false);
            $table->unsignedInteger('trial_days')->default(0);
            $table->json('features')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
