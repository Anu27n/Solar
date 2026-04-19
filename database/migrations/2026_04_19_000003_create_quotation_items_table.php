<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('position')->default(1);
            $table->text('description');
            $table->string('hsn_code')->nullable();
            $table->decimal('quantity', 12, 2)->default(1);
            $table->string('unit', 20)->default('Nos');
            $table->decimal('rate', 14, 2)->default(0);
            $table->decimal('amount', 14, 2)->default(0);
            $table->timestamps();

            $table->index(['quotation_id', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotation_items');
    }
};
