<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('system_size_kw', 8, 2);
            $table->decimal('price', 12, 2);
            $table->string('estimated_generation')->nullable();
            $table->text('warranty_details')->nullable();
            $table->text('description')->nullable();
            $table->enum('type', ['domestic', 'commercial'])->default('domestic');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
