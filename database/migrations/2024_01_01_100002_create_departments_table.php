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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Department name');
            $table->string('slug')->unique()->comment('URL-friendly department identifier');
            $table->text('description')->nullable()->comment('Department overview');
            $table->string('head_name')->nullable()->comment('Department head name');
            $table->string('contact_email')->nullable()->comment('Department contact email');
            $table->string('contact_phone')->nullable()->comment('Department contact phone');
            $table->text('address')->nullable()->comment('Department physical address');
            $table->string('image')->nullable()->comment('Department photo/logo');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            
            $table->index('slug');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};