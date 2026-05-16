<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catalog_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_profile_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('sku')->nullable();
            $table->string('unit', 32)->default('Nos');
            $table->decimal('list_price', 14, 2)->nullable();
            $table->unsignedInteger('stock_quantity')->default(0);
            $table->boolean('is_published')->default(true);
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();

            $table->index(['company_profile_id', 'is_published', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catalog_items');
    }
};
