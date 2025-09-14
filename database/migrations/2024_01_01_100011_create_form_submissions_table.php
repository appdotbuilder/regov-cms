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
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained()->onDelete('cascade');
            $table->json('data')->comment('Submitted form data (JSON)');
            $table->string('submitter_name')->nullable()->comment('Name of person who submitted');
            $table->string('submitter_email')->nullable()->comment('Email of person who submitted');
            $table->string('ip_address')->nullable()->comment('IP address of submitter');
            $table->enum('status', ['pending', 'processed', 'archived'])->default('pending');
            $table->text('notes')->nullable()->comment('Admin notes about this submission');
            $table->timestamps();
            
            $table->index('form_id');
            $table->index('status');
            $table->index('submitter_email');
            $table->index(['form_id', 'status']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_submissions');
    }
};