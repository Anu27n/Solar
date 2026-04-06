<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('channel_partner_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->string('phone', 20);
            $table->string('email')->nullable();
            $table->text('address');
            $table->string('city');
            $table->string('state')->default('Uttar Pradesh');

            $table->string('installation_location')->nullable();
            $table->decimal('system_capacity_kw', 8, 2)->nullable();
            $table->string('package_selected')->nullable();
            $table->enum('installation_type', ['domestic', 'commercial'])->default('domestic');
            $table->enum('payment_method', ['cash', 'loan'])->default('cash');

            $table->enum('status', [
                'registration_completed',
                'kyc_pending',
                'kyc_approved',
                'kyc_rejected',
                'loan_applied',
                'loan_approved',
                'loan_rejected',
                'installation_scheduled',
                'installation_completed',
                'installation_rejected'
            ])->default('registration_completed');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
