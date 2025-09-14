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
        Schema::create('visitor_stats', function (Blueprint $table) {
            $table->id();
            $table->date('date')->comment('Date of the visit');
            $table->string('page_url')->comment('Visited page URL');
            $table->string('page_title')->nullable()->comment('Page title');
            $table->string('ip_address')->nullable()->comment('Visitor IP address');
            $table->string('user_agent')->nullable()->comment('Visitor browser/device info');
            $table->string('referrer')->nullable()->comment('Referrer URL');
            $table->integer('session_duration')->default(0)->comment('Session duration in seconds');
            $table->timestamps();
            
            $table->index('date');
            $table->index('page_url');
            $table->index('ip_address');
            $table->index(['date', 'page_url']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_stats');
    }
};