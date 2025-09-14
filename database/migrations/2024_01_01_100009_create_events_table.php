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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Event title');
            $table->string('slug')->unique()->comment('URL-friendly event identifier');
            $table->text('description')->comment('Event description');
            $table->datetime('start_date')->comment('Event start date and time');
            $table->datetime('end_date')->nullable()->comment('Event end date and time');
            $table->string('location')->nullable()->comment('Event location');
            $table->string('organizer')->nullable()->comment('Event organizer');
            $table->string('contact_email')->nullable()->comment('Contact email for event');
            $table->string('contact_phone')->nullable()->comment('Contact phone for event');
            $table->boolean('is_featured')->default(false)->comment('Featured event flag');
            $table->enum('status', ['scheduled', 'ongoing', 'completed', 'cancelled'])->default('scheduled');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
            
            $table->index('slug');
            $table->index('start_date');
            $table->index('end_date');
            $table->index('status');
            $table->index('is_featured');
            $table->index('created_by');
            $table->index('department_id');
            $table->index(['status', 'start_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};