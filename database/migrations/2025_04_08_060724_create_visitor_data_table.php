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
        Schema::create('visitor_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pixel_id')->constrained()->cascadeOnDelete();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('referrer')->nullable();
            $table->string('page_url');
            $table->string('browser')->nullable();
            $table->string('device')->nullable();
            $table->string('operating_system')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('company_ip')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_domain')->nullable();
            $table->boolean('is_processed')->default(false);
            $table->foreignId('lead_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_data');
    }
};
