<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->string('bank_name');
            $table->decimal('down_payment', 12, 2)->default(0);
            $table->decimal('loan_amount', 12, 2);
            $table->decimal('emi_amount', 12, 2)->default(0);
            $table->integer('total_emis')->default(0);
            $table->integer('emis_paid')->default(0);
            $table->integer('emis_pending')->default(0);
            $table->enum('status', ['applied', 'under_review', 'approved', 'rejected', 'disbursed'])->default('applied');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
