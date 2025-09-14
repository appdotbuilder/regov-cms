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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Announcement title');
            $table->text('content')->comment('Announcement content');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->enum('status', ['draft', 'published', 'expired'])->default('draft');
            $table->datetime('published_at')->nullable()->comment('Publication date and time');
            $table->datetime('expires_at')->nullable()->comment('Expiration date and time');
            $table->foreignId('author_id')->constrained('users');
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
            
            $table->index('status');
            $table->index('priority');
            $table->index('published_at');
            $table->index('expires_at');
            $table->index(['status', 'published_at']);
            $table->index('author_id');
            $table->index('department_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};