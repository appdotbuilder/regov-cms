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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Service title');
            $table->string('slug')->unique()->comment('URL-friendly service identifier');
            $table->text('description')->comment('Service description');
            $table->longText('requirements')->nullable()->comment('Service requirements and documents needed');
            $table->longText('process_steps')->nullable()->comment('Step-by-step process');
            $table->decimal('fee', 10, 2)->nullable()->comment('Service fee amount');
            $table->string('processing_time')->nullable()->comment('Estimated processing time');
            $table->string('contact_person')->nullable()->comment('Contact person for this service');
            $table->string('contact_email')->nullable()->comment('Contact email for this service');
            $table->string('contact_phone')->nullable()->comment('Contact phone for this service');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->foreignId('department_id')->constrained();
            $table->timestamps();
            
            $table->index('slug');
            $table->index('status');
            $table->index('department_id');
            $table->index(['status', 'department_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};