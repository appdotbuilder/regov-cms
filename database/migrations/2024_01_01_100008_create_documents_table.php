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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Document title');
            $table->text('description')->nullable()->comment('Document description');
            $table->string('file_path')->comment('Path to document file');
            $table->string('file_name')->comment('Original file name');
            $table->string('file_type')->comment('Document file type/extension');
            $table->bigInteger('file_size')->comment('File size in bytes');
            $table->enum('category', ['form', 'policy', 'report', 'manual', 'other'])->default('other');
            $table->enum('access_level', ['public', 'restricted', 'internal'])->default('public');
            $table->enum('status', ['active', 'archived'])->default('active');
            $table->foreignId('uploaded_by')->constrained('users');
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('downloads_count')->default(0)->comment('Document download counter');
            $table->timestamps();
            
            $table->index('category');
            $table->index('access_level');
            $table->index('status');
            $table->index('uploaded_by');
            $table->index('department_id');
            $table->index(['category', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};