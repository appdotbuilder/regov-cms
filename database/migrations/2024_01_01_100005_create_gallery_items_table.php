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
        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Media item title');
            $table->text('description')->nullable()->comment('Media item description');
            $table->enum('type', ['photo', 'video'])->comment('Media type');
            $table->string('file_path')->comment('Path to media file');
            $table->string('thumbnail')->nullable()->comment('Thumbnail for videos');
            $table->string('alt_text')->nullable()->comment('Alternative text for accessibility');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->foreignId('uploaded_by')->constrained('users');
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('views_count')->default(0)->comment('Media view counter');
            $table->timestamps();
            
            $table->index('type');
            $table->index('status');
            $table->index('uploaded_by');
            $table->index('department_id');
            $table->index(['type', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_items');
    }
};