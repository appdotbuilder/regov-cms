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
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Form title');
            $table->string('slug')->unique()->comment('URL-friendly form identifier');
            $table->text('description')->nullable()->comment('Form description and instructions');
            $table->json('fields')->comment('Form fields configuration (JSON)');
            $table->string('submit_email')->nullable()->comment('Email to receive form submissions');
            $table->text('success_message')->nullable()->comment('Message shown after successful submission');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('submissions_count')->default(0)->comment('Form submissions counter');
            $table->timestamps();
            
            $table->index('slug');
            $table->index('status');
            $table->index('created_by');
            $table->index('department_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};