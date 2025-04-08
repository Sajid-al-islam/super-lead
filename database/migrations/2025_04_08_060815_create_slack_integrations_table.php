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
        Schema::create('slack_integrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('webhook_url');
            $table->string('channel')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('notify_on_new_lead')->default(true);
            $table->boolean('notify_on_company_resolution')->default(false);
            $table->boolean('notify_on_email_unlock')->default(false);
            $table->dateTime('last_notification_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slack_integrations');
    }
};
